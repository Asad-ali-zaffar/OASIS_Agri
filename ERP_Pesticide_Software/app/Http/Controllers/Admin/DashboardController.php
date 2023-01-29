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
use Illuminate\Support\Facades\DB;
use App\Charts\MonthlyCustomerChart;
// use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

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
             $customer= CustomerRegisteration::count();
            $coustomerchart = (new LarapexChart)->setTitle('Coustomer')
                   ->setDataset([$customer,0])
                   ->setLabels(['Active', 'In-Active']);
            $purchase=Purchase::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->orderBy('year','desc')
            ->get();
            foreach($purchase as $key=>$item){
                $month[$item->month]=$item->data;
            }
            $purchasechart =  (new LarapexChart)->setType('area')
            ->setTitle('Total Purchase Monthly')
            ->setSubtitle('From January to December')
            ->setXAxis([
                'Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
            ])
            ->setDataset([
                [
                    'name'  =>  'Product Purchase',
                    'data'  =>  [isset($month[1])?$month[1]:0, isset($month[2])?$month[2]:0, isset($month[3])?$month[3]:0,isset($month[4])?$month[4]:0, isset($month[5])?$month[5]:0, isset($month[6])?$month[6]:0,isset($month[7])?$month[7]:0, isset($month[8])?$month[8]:0, isset($month[9])?$month[9]:0,isset($month[10])?$month[10]:0, isset($month[11])?$month[11]:0, isset($month[12])?$month[12]:0]

                    // 'data'  =>  [250, 700, 1200,250, 700, 1200,250, 700, 1200,250, 700, 1200]
                ]
            ]);
            $sales=Sale::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->orderBy('year','desc')
            ->get();
            foreach($sales as $key=>$item){
                $month[$item->month]=$item->data;
            }
            $salechart =  (new LarapexChart)->setType('line')
            ->setTitle('Total Sale Monthly')
            ->setSubtitle('From January to December')
            ->setXAxis([
                'Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
            ])
            ->setDataset([
                [
                    'name'  =>  'Product Sale',
                    'data'  =>  [isset($month[1])?$month[1]:0, isset($month[2])?$month[2]:0, isset($month[3])?$month[3]:0,isset($month[4])?$month[4]:0, isset($month[5])?$month[5]:0, isset($month[6])?$month[6]:0,isset($month[7])?$month[7]:0, isset($month[8])?$month[8]:0, isset($month[9])?$month[9]:0,isset($month[10])?$month[10]:0, isset($month[11])?$month[11]:0, isset($month[12])?$month[12]:0]
                ]
            ]);
            $emplay=EmployeesRegistration::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month')
            ->orderBy('year','desc')
            ->get();
            foreach($emplay as $key=>$item){
                $month[$item->month]=$item->data;

            }
            $empchart =  (new LarapexChart)->setType('bar')
            ->setTitle('Total Employees')
            ->setSubtitle('From January to December')
            ->setXAxis([
                'Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
            ])
            ->setDataset([
                [
                    'name'  =>  'Employees',
                    'data'  =>  [isset($month[1])?$month[1]:0, isset($month[2])?$month[2]:0, isset($month[3])?$month[3]:0,isset($month[4])?$month[4]:0, isset($month[5])?$month[5]:0, isset($month[6])?$month[6]:0,isset($month[7])?$month[7]:0, isset($month[8])?$month[8]:0, isset($month[9])?$month[9]:0,isset($month[10])?$month[10]:0, isset($month[11])?$month[11]:0, isset($month[12])?$month[12]:0]
                ]
            ]);
           $productcount= Product::count();
            $productchart =  (new LarapexChart)->setType('polarArea')
            ->setTitle('Product ')
            ->setSubtitle('Active and In-Active Chart')
            ->setDataset([10,20])
            ->setLabels(['Active Product', 'In-Active Product'])
            ->setColors([ '#03A9F4','#D32F2F']);
            return view('dashboard',compact('data','purchasechart','salechart','coustomerchart','empchart','productchart'));
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
