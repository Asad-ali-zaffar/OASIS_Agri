<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Purchase, Product, PurchasesProducts};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::all();
        if (request()->ajax()) {
            $getData = Purchase::all();
            // $getData = PurchasesProducts::select('*','purchases.id as purchases_id')
            // ->join('purchases', 'purchases.id', '=', 'purchases_products.purchaese_id')
            // ->join('products', 'products.id', '=', 'purchases_products.product_id')
            // ->get();
            return DataTables::of($getData)
                ->addColumn('action', function ($patient) {
                    return view('admin.purchase._action', compact('patient'));
                })
                ->addColumn('purchaseProducts', function ($patient) {
                    return get_purchaseProducts($patient->id);
                })
                ->make(true);
        }
        return view('admin.purchase.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $company = Product::find($request->id);
            return Response()->json($company);
        }
        $data['product'] = Product::all();
        return view('admin.purchase.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recordeId = $request->id;
        $total_bill = 0;
        foreach ($request->data as $item) {
            $total_bill += $item['product_quantity'] * $item['purchasing_price'];
        }
        Purchase::updateOrCreate(
            [
                'id' => $recordeId
            ],
            [
                'purchasing_expense' => $request->purchasing_expense,
                'total_amount' => $total_bill,
            ]
        );
        if ($recordeId == null) {
            $purchase = Purchase::latest()->first();
            $recordeId = $purchase->id;
        }
        PurchasesProducts::where(['purchaese_id' => $recordeId])->delete();
        // return $request;
        foreach ($request->data as $item) {
            PurchasesProducts::create([
                'purchaese_id' => $recordeId,
                'product_id' => $item['product_id'],
                'product_code' => $item['product_code'],
                'purchasing_price' => $item['purchasing_price'],
                'saleing_price' => $item['sale_price'],
                'expiry_date' => $item['expiry_date'],
                'product_quantity' => $item['product_quantity'],
            ]);
        }
        $data['recorde'] = $request;
        $data['total_amount']=$total_bill;
        return view('admin.purchase._bill', $data);
        // return redirect()->route('admin.purchase.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id =null)
    {

        $where = array('purchaese_id' => $id);
        $data['purchaserecorde']  = PurchasesProducts::where($where)->get();
        $data['recorde']  = Purchase::findOrFail($id);
        $data['product'] = Product::all();
        return view('admin.purchase.create', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $where = array('purchaese_id' => $request->id);
        $data['purchaserecorde']  = PurchasesProducts::where($where)->delete();
        $company = Purchase::where('id', $request->id)->delete();
        return Response()->json($company);
    }
}
