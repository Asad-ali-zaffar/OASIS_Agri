<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\EmployeesRegistration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class EmployeesRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(request()->ajax()) {
             $getData =EmployeesRegistration::select('*', DB::raw('(CASE
             WHEN employees_registrations.status = 0 THEN "In-Active"
             WHEN employees_registrations.status = 1 THEN "Active"
             WHEN employees_registrations.status = 2 THEN "Suspend"
             ELSE "Close" END) AS status'))->get();
        //     DB::table('product_method_entries')
		// ->join('tests', 'tests.id', '=', 'product_method_entries.test_id','left')
        //     ->select('product_method_entries.*','tests.name as test_name_eng', DB::raw('(CASE
		// WHEN product_method_entries.status = 0 THEN "In-Active"
		// WHEN product_method_entries.status = 1 THEN "Active"
		// WHEN product_method_entries.status = 2 THEN "Suspend"
		// ELSE "Close" END) AS status'))->get();
            return DataTables::of($getData)
            ->addColumn('status', function ($patient) {
                return view('admin.employees_registeration._status', compact('patient'));
            })
            ->addColumn('action', function ($patient) {
                return view('admin.employees_registeration._action', compact('patient'));
            })->make(true);
        }
        return view('admin.employees_registeration.index');

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
            'employe_name'=>'required',
            'father_name'=>'required',
            'CNIC'=>'required',
            'phone_number_one'=>'required',
            'designation'=>'required',
            'territory'=>'required',
            'monthly_exprince'=>'required|integer',
            'monthly_salary'=>'required|integer',
            'status'=>'required',
        ]);
        $companyId = $request->id;

	    $company   =   EmployeesRegistration::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'employe_name' =>ucfirst($request->employe_name),
	                'father_name' => ucfirst($request->father_name),
	                'CNIC' => $request->CNIC,
	                'phone_number_one' => $request->phone_number_one,
	                'phone_number_two' => $request->phone_number_two,
	                'address' => $request->address,
	                'territory' => $request->territory,
	                'designation' => ucfirst($request->designation),
	                'monthly_exprince' => $request->monthly_exprince,
	                'monthly_salary' => $request->monthly_salary,
	                'monthly_salary' => $request->monthly_salary,
	                'status' => $request->status,
	                ]);
	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesRegistration  $employeesRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesRegistration $employeesRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesRegistration  $employeesRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = EmployeesRegistration::where($where)->first();

	    return Response()->json($company);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesRegistration  $employeesRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeesRegistration $employeesRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesRegistration  $employeesRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = EmployeesRegistration::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
