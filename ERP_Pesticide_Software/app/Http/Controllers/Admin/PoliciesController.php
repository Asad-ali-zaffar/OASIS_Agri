<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Policies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $getData =Policies::select('*')->get();
            return DataTables::of($getData)
            ->addColumn('action', function ($patient) {
                return view('admin.policies._action', compact('patient'));
            })->make(true);
        }
        return view('admin.policies.index');
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
    // ['policy_name','policy_code','start_tenure_data','end_tenure_data','discount'];
    public function store(Request $request)
    {
        $request->validate([
            'policy_name'=>'required',
            'policy_code'=>'required',
            'start_tenure_data'=>'required',
            'end_tenure_data'=>'required'
        ]);
        $companyId = $request->id;
	    $company   =   Policies::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'policy_name' => $request->policy_name,
	                'policy_code' => $request->policy_code,
	                'start_tenure_data' => $request->start_tenure_data,
	                'end_tenure_data' => $request->end_tenure_data,
	                'discount' => $request->discount
	                ]);
	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function show(Policies $policies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = Policies::where($where)->first();
	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policies $policies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Policies  $policies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Policies::where('id',$request->id)->delete();
	    return Response()->json($company);
    }
}
