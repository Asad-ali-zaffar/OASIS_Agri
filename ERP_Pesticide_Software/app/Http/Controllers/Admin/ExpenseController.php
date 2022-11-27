<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Expense,Product,Purchase};
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $getData =Expense::select('*','products.product_name as product_name','expenses.id as expense_id')
            ->join('products', 'products.id', '=', 'expenses.product_id','left')
              ->get();
           return DataTables::of($getData)
           ->addColumn('action', function ($patient) {
               return view('admin.expense._action', compact('patient'));
           })->make(true);
        }
        $data['product']=Product::all();
        return view('admin.expense.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $company=Purchase::where('product_id',$request->id)->first();
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
            'purchase_price'=>'required',
            'purchase_expense'=>'required',
            'sale_expense'=>'required',
            'packing_expense'=>'required',
            'total_expense'=>'required',
            'product_quantity'=>'required',
        ]);
        $companyId = $request->id;

	    $company   =   Expense::updateOrCreate(
	    	        [
	    	         'id' => $companyId
	    	        ],
	                [
	                'product_id' =>$request->product_id,
	                'product_code' => $request->product_code,
	                'purchase_price' => $request->purchase_price,
	                'purchase_expense' => $request->purchase_expense,
	                'product_quantity' => $request->product_quantity,
	                'sale_expense' => $request->sale_expense,
	                'packing_expense' => $request->packing_expense,
	                'total_expense' => $request->total_expense,
	                ]);
	    return Response()->json($company);
        // "product_id":"3","product_code":"323","purchase_price":"1100","purchase_expense":"130","sale_expense":"130","packing_expense":"500","total_expense":"760"}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
	    $company  = Expense::where($where)->first();

	    return Response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Expense::where('id',$request->id)->delete();

	    return Response()->json($company);
    }
}
