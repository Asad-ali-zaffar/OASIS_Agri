<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    EmployeesRegistration,
    CustomerRegisteration,
    Purchase,
    Sale,
    Product,
    Expense,
    ReturnedProduct,
    SalaryPay
};
use App\Charts\MonthlyCustomerChart;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MonthlyCustomerChart $coustomerChart)
    {

            $data['EmployeesRegistration']=EmployeesRegistration::all();
            $data['CustomerRegisteration']=CustomerRegisteration::all();
            $data['Purchase']=Purchase::all();
            $data['Sale']=Sale::all();
            $data['Product']=Product::all();
            $data['Expense']=Expense::all();
            $data['ReturnedProduct']=ReturnedProduct::all();
            $data['SalaryPay']=SalaryPay::all();
            $data['chart']=$coustomerChart;
            return view('dashboard',compact('data'));
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
        //
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
    public function edit($id)
    {
        //
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
