<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Purchase,Product};
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
        $data['product']=Product::all();
        if(request()->ajax()) {
            $getData =Purchase::select('*','products.product_name as product_name','purchases.id as purchases_id')
          ->join('products', 'products.id', '=', 'purchases.product_id','left')
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
               return view('admin.purchase._action', compact('patient'));
           })->make(true);
       }
       return view('admin.purchase.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $company=Product::find($request->id);
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
            'product_id'=>'required',
            'product_code'=>'required',
            'purchasing_price'=>'required|integer',
            'sealing_price'=>'required|integer',
            'expiry_date'=>'required|date',
            'purchasing_expense'=>'required|integer',
            'product_quantity'=>'required|integer',
        ]);
        $companyId = $request->id;

	    $company   =   Purchase::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'product_id' =>$request->product_id,
	                'product_code' => $request->product_code,
	                'purchasing_price' => $request->purchasing_price,
	                'sealing_price' => $request->sealing_price,
	                'expiry_date' => $request->expiry_date,
	                'purchasing_expense' => $request->purchasing_expense,
	                'product_quantity' => $request->product_quantity
	                ]);
	    return Response()->json($company);
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
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = Purchase::where($where)->first();

	    return Response()->json($company);
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
        $company = Purchase::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
