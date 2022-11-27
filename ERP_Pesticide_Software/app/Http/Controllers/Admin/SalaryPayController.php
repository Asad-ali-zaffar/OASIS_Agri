<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{SalaryPay,EmployeesRegistration};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class SalaryPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $getData = SalaryPay::select('*','employees_registrations.employe_name as employee_name','salary_pays.id as pay_id', DB::raw('(CASE
            WHEN salary_pays.status = 0 THEN "Un-Paid"
            WHEN salary_pays.status = 1 THEN "Paid"
            ELSE "Panding" END) AS status'))
            ->join('employees_registrations', 'employees_registrations.id', '=', 'salary_pays.employee_id','left')
            ->get();

            return DataTables::of($getData)
            ->addColumn('date', function ($patient) {
                return view('admin.salary_pays.date', compact('patient'));
            })
            ->addColumn('status', function ($patient) {
                    return view('admin.salary_pays._status', compact('patient'));
                })
                ->addColumn('action', function ($patient) {
                    return view('admin.salary_pays._action', compact('patient'));
                })->make(true);
        }
        $data['employee']=EmployeesRegistration::all();
        return view('admin.salary_pays.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company=EmployeesRegistration::find($request->id);
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
        //['employee_id','so_of','CNIC','designation','monthly_salary','total_monthly_expence','total_amount'];
        $request->validate([
            'employee_id'=>'required|integer',
            'so_of'=>'required',
            'CNIC'=>'required',
            'designation'=>'required',
            'monthly_salary'=>'required',
            'total_monthly_expence'=>'required',
            'total_amount'=>'required',
        ]);
        $companyId = $request->id;

	    $company   =   SalaryPay::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'employee_id' =>$request->employee_id,
	                'so_of' => $request->so_of,
	                'CNIC' => $request->CNIC,
	                'designation' => $request->designation,
	                'monthly_salary' => $request->monthly_salary,
	                'total_monthly_expence' => $request->total_monthly_expence,
	                'total_amount' => $request->total_amount,
	                'status' => $request->status,
	                ]);
	    return Response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryPay  $salaryPay
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryPay $salaryPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryPay  $salaryPay
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = SalaryPay::where($where)->first();

	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryPay  $salaryPay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryPay $salaryPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryPay  $salaryPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = SalaryPay::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
