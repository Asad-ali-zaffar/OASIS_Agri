<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Purchase, Seal, Product, ReturnedProduct, Expense};
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $purchase = Purchase::all();
            foreach ($purchase as  $value) {
                $product_id = $value->product_id;
                $data['purchasee'] = purchase::where('product_id', $product_id)->get();
                $q[$value->product_id] = 0;
                foreach ($data['purchasee'] as $val) {
                    $q[$value->product_id] += $val->product_quantity;
                }

                $data['seal'] = Seal::where('product_id', $product_id)->get();
                $sq[$value->product_id] = 0;
                foreach ($data['seal'] as $val) {
                    $sq[$value->product_id] += $val->product_quantity;
                }
                $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->get();
                $empty = count($data['returnedproduct']);
                if ($empty != 0) {
                    foreach ($data['returnedproduct'] as $val) {
                        $sq[$value->product_id] -= $val->product_quantity;
                    }
                }
                $quantity[$value->product_id] = 0;
            }
            // return $sq;

            foreach ($purchase as  $value) {
                $value->product_quantity = $q[$value->product_id] - $sq[$value->product_id];
            }
            $id = 0;
            $stock[0] = 0;
            foreach ($purchase as $key => $value) {
                if ($id != $value->product_id) {
                    $id = $value->product_id;
                    $status = "";
                    if ($value->product_quantity > 0) {
                        $status = 'Available';
                    } else {
                        $status = 'Not Available';
                    }
                    $product = Product::find($id);
                    $stock[$key] = array('id' => $value->id, 'product_id' => $product->product_name, 'product_code' => $value->product_code, 'product_quantity' => $value->product_quantity, 'status' => $status);
                }
            }
            return DataTables::of($stock)->editColumn('status', function ($patient) {
                return view('admin.product_stock._status', compact('patient'));
            })->make(true);
        }
        return view('admin.product_stock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (request()->ajax()) {
            $seal = purchase::all();
            foreach ($seal as  $value) {
                $product_id = $value->product_id;
                $data['expense'] = Expense::where('product_id', $product_id)->get();
                $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->get();
                $data['seal'] = Seal::where('product_id', $product_id)->get();
                $empty = count($data['seal']);
                $emptyr = count($data['returnedproduct']);
                $sq[$value->product_id] = 0;
                if ($empty >= 0) {
                    foreach ($data['seal'] as $val) {
                        $sq[$value->product_id] += $val->product_quantity;
                    }
                } else {
                    $sq[$value->product_id] = $empty;
                }
                if ($emptyr >= 0) {
                    foreach ($data['returnedproduct'] as $val) {
                        $sq[$value->product_id] -= $val->product_quantity;
                    }
                }
                $amount[$value->product_id] = $value->sealing_price * $sq[$value->product_id];
                foreach ($data['expense'] as $val) {
                    $amount[$value->product_id] -= $val->total_expense;
                    $exp[$value->product_id] = $val->total_expense;
                }
                $quantity[$value->product_id] = 0;
                  }
            // return $sq;
            // return $exp;
            // return $return;
            $id = 0;

            foreach ($seal as $key => $value) {
                if ($id != $value->product_id) {
                    $id = $value->product_id;
                    $status = "";
                    if ($sq[$value->product_id] > 0) {
                        $status = 'Saling';
                    } else {
                        if ($amount[$value->product_id] < 0) {
                            $status = 'Loss';
                        } else {
                            $status = 'Not Saling';
                        }
                    }
                     $product = Product::find($id);
                     $stock[$key] = array('product_id' => $product->product_name, 'product_code' => $value->product_code, 'product_quantity' => $sq[$value->product_id], 'product_price' => $value->sealing_price, 'product_expence' => $exp[$value->product_id], 'product_amount' => $amount[$value->product_id], 'status' => $status);
                }
            }
            // return $stock;
            return DataTables::of($stock)
            ->editColumn('status', function ($patient) {
                return view('admin.consumed_sale_product._status', compact('patient'));
            })->make(true);
        }
        return view('admin.consumed_sale_product.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (request()->ajax()) {
        $returnproduct =  ReturnedProduct::all();
        foreach ($returnproduct as $request) {
            $data['returnedproduct'] = ReturnedProduct::where('product_id', $request->product_id)->where('customer_id', $request->customer_id)->get();
            $sq[$request->product_id] = 0;
            foreach ($data['returnedproduct'] as $val) {
                $sq[$request->product_id] += $val->product_quantity;
            }
            $stock[$request->product_id] = 0;
        }
        //    return $returnproduct;
        // return $sq;
        // $stock[0] = 0;
        $p_id = 0;
        $c_id = 0;
        foreach($returnproduct as $key=>$value){
            if ($p_id != $value->product_id && $c_id != $value->product_id) {
              $c_id=$value->customer_id;
                $p_id=$value->product_id;
            $product = Product::find($value->product_id);
            $stock[$value->product_id]=array('product_id' => $product->product_name, 'product_code' => $value->product_code, 'product_quantity' => $sq[$value->product_id], 'product_price' => $value->product_seal_price,  'product_amount' => $sq[$value->product_id]*$value->product_seal_price);
            // $stock[$value->id]=array('product_id' => $product->product_name, 'product_code' => $value->product_code, 'product_quantity' => $sq[$value->product_id], 'product_price' => $value->product_seal_price,  'product_amount' => $sq[$value->product_id]*$value->product_seal_price);


            }
        }
        // die;
        // return $stock;

            return DataTables::of($stock)->make(true);
        }
        return view('admin.return_products.index');
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
