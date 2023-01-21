<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ReturnedProduct, Sale, CustomerRegisteration, Purchase, Product, SaleProduct, ReturnSaleProduct};
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\DB;

class ReturnedProductController extends Controller
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
        if (request()->ajax()) {
            // $getData = ReturnSaleProduct::all();
            // $getData = ReturnSaleProduct::select('*', 'products.product_name as product_name', 'returned_products.id as return_id', 'customer_registerations.customer_name as customer_name')
            //     ->join('returned_products', 'returned_products.id', '=', 'return_sale_products.returnSP_id')
            //     ->join('customer_registerations', 'customer_registerations.id', '=', 'return_sale_products.customer_id')
            //     ->join('products', 'products.id', '=', 'return_sale_products.product_id')
            //     ->get();
            $getData = ReturnedProduct::all();
            return DataTables::of($getData)
                ->addColumn('customer_name', function ($patient) {
                    return get_customer($patient->customer_id)->customer_name;
                })
                ->addColumn('return_amount', function ($patient) {
                    // return get_salesRecordes($patient->id,$patient->customer_id);
                    return ReturnSaleProduct::where(['returnSP_id'=>$patient->id,'customer_id'=>$patient->customer_id])->sum('return_amount');
                })
                ->addColumn('return_product', function ($patient) {
                    return get_returnsalesRecordes($patient->id,$patient->customer_id);

                    // return view('admin.returned_product.return_amount', compact('patient'));
                })
                ->addColumn('action', function ($patient) {
                    return view('admin.returned_product._action', compact('patient'));
                })->make(true);
        }
        return view('admin.returned_product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (request()->ajax()) {
            $Sale = SaleProduct::where(['product_id' => $request->id, 'customer_id' => $request->c_id])->first();
            $Sales = SaleProduct::where(['product_id' => $request->id, 'customer_id' => $request->c_id])->get();
            $Sale->product_quantity = 0;
            foreach ($Sales as $item) {
                $Sale->product_quantity += $item->product_quantity;
            }
            return Response()->json($Sale);
        }
        $data['product'] = Product::all();
        $data['customer'] = CustomerRegisteration::all();
        return view('admin.returned_product.create_edit', $data);
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
            'return_date_and_time' => 'required',
        ]);
        // return $request;
        $recordeId = $request->id;
        $total = 0;
        foreach ($request->data as $item) {
            $total += $item['product_Sale_price'] * $item['receivedQuantity'];
        }
        ReturnedProduct::updateOrCreate(
            [
                'id' => $recordeId
            ],
            [
                'customer_id' => $request->customer_id,
                'customer_phone_no' => $request->customer_phone_no,
                'customer_CNiC' => $request->customer_CNiC,
                'return_date_and_time' => $request->return_date_and_time,
                'returnTotalAmount' => $total,
            ]
        );

        if ($recordeId == null) {
            $returnedProduct = ReturnedProduct::latest()->first();
            $recordeId = $returnedProduct->id;
        }
        ReturnSaleProduct::where(['returnSP_id' => $recordeId, 'customer_id' => $request->customer_id])->delete();

        foreach ($request->data as $item) {
            ReturnSaleProduct::create([
                'returnSP_id' => $recordeId,
                'customer_id' => $request->customer_id,
                'product_id' => $item['product_id'],
                'product_code' => $item['product_code'],
                'product_sale_price' => $item['product_Sale_price'],
                'product_quantity' => $item['Sale_product_quantity'],
                'receivedQuantity' => $item['receivedQuantity'],
                'return_amount' => $item['receivedQuantity'] * $item['product_Sale_price']
            ]);
        }
        $data['recorde']=$request;
        $data['total']=$total;

        return view('admin.returned_product._bill',$data);
        // return redirect()->route('admin.returned_product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedProduct  $returnedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $company = Sale::where('customer_id', $request->id)->firstOrFail();
        return Response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedProduct  $returnedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data['recode']= ReturnedProduct::where('id',$request->id)->first();
        $where = array('returnSP_id' => $request->id);
        $data['recodes']  = ReturnSaleProduct::where($where)->get();
        $data['product'] = Product::all();
        $data['customer'] = CustomerRegisteration::all();
        return view('admin.returned_product.create_edit',$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnedProduct  $returnedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnedProduct $returnedProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedProduct  $returnedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         ReturnedProduct::where('id', $request->id)->delete();
         $where = array('returnSP_id' => $request->id);
         ReturnSaleProduct::where($where)->delete();
         $message='Recode Successfuly Deleted!';
        return Response()->json($message);
    }
}
