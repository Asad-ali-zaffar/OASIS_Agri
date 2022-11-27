<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ReturnedProduct,Seal,CustomerRegisteration,Purchase,Product};
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
        $data['product']=Product::all();
        $data['customer']=CustomerRegisteration::all();
        if(request()->ajax()) {
            $getData =ReturnedProduct::select('*','products.product_name as product_name','returned_products.id as return_id','customer_registerations.customer_name as customer_name')
          ->join('customer_registerations', 'customer_registerations.id', '=', 'returned_products.customer_id','left')
          ->join('products', 'products.id', '=', 'returned_products.product_id','left')
            ->get();
            //
       //     DB::table('product_method_entries')
       // ->join('tests', 'tests.id', '=', 'product_method_entries.test_id','left')
       //     ->select('product_method_entries.*','tests.name as test_name_eng', DB::raw('(CASE
       // WHEN product_method_entries.status = 0 THEN "In-Active"
       // WHEN product_method_entries.status = 1 THEN "Active"
       // WHEN product_method_entries.status = 2 THEN "Suspend"
       // ELSE "Close" END) AS status'))->get();
       foreach($getData as $key=> $data){
        $data->return_date_and_time=date('Y-m-d  h-m-s A',strtotime($data->return_date_and_time));
       }
           return DataTables::of($getData)
           ->addColumn('action', function ($patient) {
               return view('admin.returned_product._action', compact('patient'));
           })->make(true);
       }
       return view('admin.returned_product.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Seal=Seal::where('product_id',$request->id)->where('customer_id',$request->c_id)->get();
        $ReturnedProduct=ReturnedProduct::where('product_id',$request->id)->where('customer_id',$request->c_id)->get();
        $quantity=0;
        foreach($Seal as $value){
            $quantity+=$value->product_quantity;
        }
        $return_q=0;
        foreach($ReturnedProduct as $value){
            $return_q+=$value->product_quantity;
        }
        $quantity-=$return_q;
        $company=Seal::where('product_id',$request->id)->where('customer_id',$request->c_id)->first();
        $company['product_quantity']=$quantity;
        $count=is_null($company);
        if($count != 0){
            $value =Product::find($request->id);
           $company= array('product_id' => $request->id, 'product_code' => $value->product_code, 'product_quantity' => 0 ,'product_seal_price'=>0);
        }
        return Response()->json($company);
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
            'customer_id'=>'required',
            'customer_phone_no'=>'required',
            'customer_CNiC'=>'required',
            'product_id'=>'required',
            'product_code'=>'required',
            'product_seal_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'return_date_and_time'=>'required',
        ]);
        $companyId = $request->id;
        $charges_amount=$request->delivery_charges*$request->product_quantity;
        $total_bill=$request->product_quantity*$request->product_seal_price;
        $total=$total_bill+$charges_amount;
	    $company= ReturnedProduct::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'customer_id' =>$request->customer_id,
	                'customer_phone_no' =>$request->customer_phone_no,
	                'customer_CNiC' =>$request->customer_CNiC,
	                'product_id' =>$request->product_id,
	                'product_code' => $request->product_code,
	                'product_seal_price'=>$request->product_seal_price,
	                'delivery_charges' => $request->delivery_charges,
	                'charges_amount' => $charges_amount,
	                'product_quantity' => $request->product_quantity,
	                'return_date_and_time' => $request->return_date_and_time,
	                'total_bill' => $total,
	                ]);

	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedProduct  $returnedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $company=CustomerRegisteration::find($request->id);
        $company=Seal::where('customer_id',$request->id)->firstOrFail();
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
        $where = array('id' => $request->id);
	    $company  = ReturnedProduct::where($where)->first();

	    return Response()->json($company);
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
        $company = ReturnedProduct::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
