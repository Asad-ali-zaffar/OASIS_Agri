<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Seal,CustomerRegisteration,Purchase,Product,BuyPolicies,Policies};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\DB;

class SealController extends Controller
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
        $data['policies']=Policies::all();
        if(request()->ajax()) {
            $getData =Seal::select('*','policies.policy_name as policy_name','products.product_name as product_name','seals.id as seal_id','customer_registerations.customer_name as customer_name')
          ->join('customer_registerations', 'customer_registerations.id', '=', 'seals.customer_id','left')
          ->join('products', 'products.id', '=', 'seals.product_id','left')
          ->join('policies', 'policies.id', '=', 'seals.policy_id','left')
            ->get();
            //
       //     DB::table('product_method_entries')
       // ->join('tests', 'tests.id', '=', 'product_method_entries.test_id','left')
       //     ->select('product_method_entries.*','tests.name as test_name_eng', DB::raw('(CASE
       // WHEN product_method_entries.status = 0 THEN "In-Active"
       // WHEN product_method_entries.status = 1 THEN "Active"
       // WHEN product_method_entries.status = 2 THEN "Suspend"
       // ELSE "Close" END) AS status'))->get();
           return DataTables::of($getData)
           ->addColumn('action', function ($patient) {
               return view('admin.seal._action', compact('patient'));
           })->make(true);
       }
       return view('admin.seal.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company=Purchase::where('product_id',$request->id)->firstOrFail();
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
        // return $request;
        $request->validate([
            'customer_id'=>'required',
            'customer_phone_no'=>'required',
            'customer_CNiC'=>'required',
            'product_id'=>'required',
            'product_code'=>'required',
            'product_seal_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'policy_id'=>'required|integer',
        ]);
        $companyId = $request->id;
        $charges_amount=$request->delivery_charges;
        // $charges_amount=$request->delivery_charges*$request->product_quantity;
        $total_bill=$request->product_quantity*$request->product_seal_price;
        $total=$request->delivery_charges+$total_bill;
        $total=($total_bill/($request->credit_note+$request->policy_discount))*100;


	    $company= Seal::updateOrCreate(
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
	                'policy_id'=>$request->policy_id,
	                'policy_code'=>$request->policy_code,
	                'policy_discount'=>$request->policy_discount,
	                'credit_note'=>$request->credit_note,
	                'delivery_charges' => $request->delivery_charges,
	                'charges_amount' => $charges_amount,
	                'recive_amount' => $request->recive_amount,
	                'product_quantity' => $request->product_quantity,
	                'total_bill' => $total,
	                ]);
                    $data=CustomerRegisteration::findOrFail($request->customer_id);
                    $advance_amount=$data->advance_payment;
                    $data->update([
                        'advance_payment'=>$advance_amount+$request->recive_amount
                    ]);


	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $company=CustomerRegisteration::findOrFail($request->id);
        // $company=BuyPolicies::where(['customer_id'=>$request->id,'policy_incentives_status'=>0])->get();
        return Response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = Seal::where($where)->firstOrFail();

	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $company=BuyPolicies::where([
            'customer_id'=>$request->customer_id,
            'policy_id'=>$request->policy_id,
            'policy_incentives_status'=>0
            ])->firstOrFail();
            return Response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seal  $seal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Seal::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
