<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CustomerRegisteration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use DB;

class CustomerRegisterationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $getData =CustomerRegisteration::select('*')->get();
        //     DB::table('product_method_entries')
		// ->join('tests', 'tests.id', '=', 'product_method_entries.test_id','left')
        //     ->select('product_method_entries.*','tests.name as test_name_eng', DB::raw('(CASE
		// WHEN product_method_entries.status = 0 THEN "In-Active"
		// WHEN product_method_entries.status = 1 THEN "Active"
		// WHEN product_method_entries.status = 2 THEN "Suspend"
		// ELSE "Close" END) AS status'))->get();
            return DataTables::of($getData)
            ->addColumn('action', function ($patient) {
                return view('admin.customer_registeration._action', compact('patient'));
            })->make(true);
        }
        return view('admin.customer_registeration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'customer_name'=>'required',
            'father_name'=>'required',
            'CNIC'=>'required',
            'phone_number_one'=>'required',
            'adress'=>'required',
        ]);
        $companyId = $request->id;

	    $company   =   CustomerRegisteration::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'customer_name' => $request->customer_name,
	                'father_name' => $request->father_name,
	                'CNIC' => $request->CNIC,
	                'phone_number_one' => $request->phone_number_one,
	                'phone_number_two' => $request->phone_number_two,
	                'adress' => $request->adress,
	                'advance_payment' => $request->advance_payment,
	                'panding_bill' => $request->panding_bill,
	                ]);

	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerRegisteration  $customerRegisteration
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerRegisteration $customerRegisteration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerRegisteration  $customerRegisteration
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = CustomerRegisteration::where($where)->first();

	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerRegisteration  $customerRegisteration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerRegisteration $customerRegisteration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerRegisteration  $customerRegisteration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = CustomerRegisteration::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
