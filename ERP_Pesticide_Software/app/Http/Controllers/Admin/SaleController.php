<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Sale,
    CustomerRegisteration,
    Purchase,
    Product,
    BuyPolicies,
    Policies,
    SaleProduct
};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::all();
        $data['customer'] = CustomerRegisteration::all();
        $data['policies'] = Policies::all();
        if (request()->ajax()) {
            $getData = Sale::select('*', 'sales.id as sale_id', 'customer_registerations.customer_name as customer_name')
                ->join('customer_registerations', 'customer_registerations.id', '=', 'sales.customer_id', 'left')
                ->get();
            return DataTables::of($getData)
                ->addColumn('sales_product', function ($patient) {
                    return get_saleProductesRecordes($patient->id,$patient->customer_id);
                })
                ->addColumn('action', function ($patient) {
                    return view('admin.sale._action', compact('patient'));
                })
                ->make(true);
        }
        return view('admin.sale.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company = Purchase::where('product_id', $request->id)->firstOrFail();
        return Response()->json($company);
    }
    public function create_sale()
    {
        $data['product'] = Product::all();
        $data['customer'] = CustomerRegisteration::all();
        $data['policies'] = Policies::all();
        $data['url'] = route('admin.sale.create_sale');
        return view('admin.sale.create_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'customer_phone_no' => 'required',
            'customer_CNiC' => 'required',
            'policy_name'=>'required'
        ]);
        $total_bill = 0;
        foreach ($request->data as $item) {
            $total_bill += $item['product_quantity'] * $item['product_Sale_price'];
        }
        $saleId = $request->id;
        $sale = Sale::updateOrCreate(
            [
                'id' => $saleId
            ],
            [
                'customer_id' => $request->customer_id,
                'customer_phone_no' => $request->customer_phone_no,
                'customer_CNiC' => $request->customer_CNiC,
                'delivery_charges' => $request->delivery_charges,
                'recive_amount' => $request->recive_amount,
                'total_bill' => $total_bill,
                'policy_name'=>$request->policy_name,
            ]
        );
        if ($saleId == null) {
            $sale = Sale::latest()->first();
            $saleId = $sale->id;
        }
        SaleProduct::where(['sale_id' => $saleId, 'customer_id' => $request->customer_id])->delete();
        foreach ($request->data as $item) {
            SaleProduct::create([
                'sale_id' => $saleId,
                'customer_id' => $request->customer_id,
                'product_id' => $item['product_id'],
                'product_code' => $item['product_code'],
                'product_sale_price' => $item['product_Sale_price'],
                'product_quantity' => $item['product_quantity'],
                'product_bill' => $item['product_quantity'] * $item['product_Sale_price']
            ]);
        }
        $data['recorde'] = $request;
        return view('admin.Sale._bill', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $company = CustomerRegisteration::findOrFail($request->id);
        // $company=BuyPolicies::where(['customer_id'=>$request->id,'policy_incentives_status'=>0])->get();
        return Response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        // $where = array('id' => $request->id);
        $where = array('id' => $id);
        $data['recode']= Sale::where($where)->firstOrFail();
        $data['salerecodes'] =SaleProduct::where('sale_id',$id)->get();
        $data['product'] = Product::all();
        $data['customer'] = CustomerRegisteration::all();
        $data['policies'] = Policies::all();
        $data['url'] = route('admin.sale.store');

        return view('admin.sale.create_edit',$data);
        // return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $company = BuyPolicies::where([
            'customer_id' => $request->customer_id,
            'policy_id' => $request->policy_id,
            'policy_incentives_status' => 0
        ])->firstOrFail();
        return Response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $Sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Sale::where('id', $request->id)->delete();
        SaleProduct::where('sale_id',$request->id)->delete();
        $message='Recode Successfuly Deleted';
        return Response()->json($message);
    }
}
