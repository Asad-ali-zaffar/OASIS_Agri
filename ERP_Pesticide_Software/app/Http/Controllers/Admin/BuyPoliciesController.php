<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyPolicies;
use Yajra\DataTables\DataTables;
use App\Models\{CustomerRegisteration,Policies};

class BuyPoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customer']=CustomerRegisteration::all();
        $data['policies']=Policies::all();
        if(request()->ajax()) {
            $getData =BuyPolicies::select('*','buy_policies.discount as buy_policy_discount','buy_policies.id as buy_policy_id','policies.policy_name as policy_name','customer_registerations.customer_name as customer_name')
            ->join('customer_registerations', 'customer_registerations.id', '=', 'buy_policies.customer_id','left')
            ->join('policies', 'policies.id', '=', 'buy_policies.policy_id','left')
            ->get();
            return DataTables::of($getData)
            ->editColumn('customer_name', function($patient) {
                return ucfirst($patient->customer_name);
            })
            ->editColumn('policy_name', function($patient) {
                return ucfirst($patient->policy_name);
            })
            ->editColumn('start_tenure_data', function($patient) {
                return date('d/M/Y',strtotime($patient->start_tenure_data));
            })
            ->editColumn('end_tenure_data', function($patient) {
                return date('d/M/Y',strtotime($patient->end_tenure_data));
            })
            ->addColumn('policy_incentives_status', function($patient) {
                if(date('Y-m-d') <= $patient->end_tenure_data )
                {
                    $status=0;
                    BuyPolicies::find($patient->id)->update(['policy_incentives_status'=>$status]);
                }else{
                    $status=1;
                    BuyPolicies::find($patient->id)->update(['policy_incentives_status'=>$status]);
                }
                return view('admin.BuyPolicies._status', compact('status'));
            })
            ->addColumn('action', function ($patient) {
                return view('admin.BuyPolicies._action', compact('patient'));
            })->make(true);
        }
        return view('admin.BuyPolicies.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company=Policies::find($request->id);
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
            'policy_id'=>'required',
        ]);
        $companyId = $request->id;

	    $company =BuyPolicies::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'customer_id' =>$request->customer_id,
	                'customer_phone_no' => $request->customer_phone_no,
	                'address' => $request->address,
	                'policy_id' => $request->policy_id,
	                'policy_code' => $request->policy_code,
	                'start_tenure_data' => $request->start_tenure_data,
	                'end_tenure_data' => $request->end_tenure_data,
	                'discount' => $request->discount,
	                'post_sale_incentive' => $request->post_sale_incentive,
	                'cash_incentive' => $request->cash_incentive,
                    'policy_incentives_status'=>0,
	                'cash_deposited' => $request->cash_deposited,
	                'remaining_amount' => $request->remaining_amount,
	                'credit_note' => $request->credit_note,
	                ]);
                    $customer= CustomerRegisteration::findOrFail($request->customer_id);
                    $advance_amount=$customer->advance_payment;
                    $customer->update([
                        'advance_payment'=>$advance_amount+$request->cash_deposited,
                    ]);
	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = BuyPolicies::where($where)->first();
	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
