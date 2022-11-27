<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\{
    Purchase,
    Seal,
    Product,
    ReturnedProduct,
    Expense,
    CustomerRegisteration,
    BuyPolicies,
    Policies
};


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $seal = purchase::all();
            foreach ($seal as  $value) {
                $product_id = $value->product_id;
                $return[$value->product_id] =  $data['expense'] = Expense::where('product_id', $product_id)->get();
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
                $exp_pur[$value->product_id] = 0;
                $exp_pac[$value->product_id] = 0;
                $exp_sal[$value->product_id] = 0;

                foreach ($data['expense'] as $val) {
                    $amount[$value->product_id] -= $val->total_expense;
                    $exp[$value->product_id] = $val->total_expense;
                    $exp_pur[$value->product_id] += $val->purchase_expense;
                    $exp_pac[$value->product_id] += $val->packing_expense;
                    $exp_sal[$value->product_id] += $val->sale_expense;
                }
                $quantity[$value->product_id] = 0;
            }
            // return $amount;
            // return $return;
            $id = 0;
            // $stock[0] = array();
            foreach ($seal as $key => $value) {
                if ($id != $value->product_id) {
                    $id = $value->product_id;
                    $status = "";
                    if ($sq[$value->product_id] > 0) {
                        $status = 'Sealing';
                    } else {
                        if ($amount[$value->product_id] < 0) {
                            $status = 'Loss';
                        } else {
                            $status = 'Not Sealing';
                        }
                    }
                    $product = Product::find($id);
                    $stock[$key] = array('product_id' => $product->product_name, 'product_code' => $value->product_code, 'product_quantity' => $sq[$value->product_id], 'product_price' => $value->sealing_price, 'purchasee_expence' => $exp_pur[$value->product_id], 'packing_expence' => $exp_pac[$value->product_id], 'sales_expense' => $exp_sal[$value->product_id], 'product_expence' => $exp[$value->product_id]);
                }
            }
            // return $stock;
            return DataTables::of($stock)->make(true);
        }
        return view('admin.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request;
        $data['customer'] = CustomerRegisteration::all();
        if (request()->ajax()) {
            $sale = Seal::all();
            foreach ($sale as $key => $value) {
                $product_id = $value->product_id;
                $customer_id = $value->customer_id;
                $return[$value->id] = $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->where('customer_id', $customer_id)->get();
                $data['seal'] = Seal::where('product_id', $product_id)->get();
                foreach ($data['seal'] as  $val) {
                    $seal[$product_id] = $val;
                }
                foreach ($data['returnedproduct'] as $val) {
                    $returnedproduct[$product_id] = $val;
                }
            }
            // return $returnedproduct;

            //
            $indexes = 0;
            $totalBill = 0;
            $payable = 0;
            $reciveable = 0;
            foreach ($sale as $key => $value) {
                $return[$value->id] = $seal[$value->product_id]->customer_id;
                $data['customer'] = CustomerRegisteration::find($seal[$value->product_id]->customer_id);
                $data['product'] = Product::find($seal[$value->product_id]->product_id);
                if ($indexes > 1) {
                    $data['customer']->advance_payment = 0;
                }
                if (in_array($seal[$value->product_id]->customer_id, $return, TRUE)) {
                    $indexes++;
                }
                $total_q = $seal[$value->product_id]->product_quantity - $returnedproduct[$value->product_id]->product_quantity;
                // $totalBill += $bill = $total_q * $seal[$value->product_id]->total_bill;
                $totalBill += $bill = $seal[$value->product_id]->total_bill;
                if ($key == 0) {
                    $payable = $total = $bill - $data['customer']->advance_payment;
                } elseif ($payable > 0) {
                    $payable = $total = $payable - $bill;
                    if ($payable <= 0) {
                        $reciveable = $bill - $payable;
                        $payable = 0;
                    }
                } else {
                    $reciveable = $bill;
                    $payable = 0;
                }
                $Policies = Policies::find($value->policy_id);
                $stock[$key] = array(
                    'customer_id' => $data['customer']->customer_name,
                    'product_id' => $data['product']->product_name,
                    'product_quantity' => $seal[$value->product_id]->product_quantity,
                    'product_seal_price' => $seal[$value->product_id]->product_seal_price,
                    'created_at' => date('d-M-y', strtotime($seal[$value->product_id]->created_at)),
                    'policy_name' => $Policies->policy_name,
                    'policy_code' => $value->policy_code,
                    'policy_discount' => $value->policy_discount,
                    'credit_note' => $value->credit_note,
                    'total_quantity' => $total_q,
                    'bill' => $bill,
                    'return_product_quantity' => $returnedproduct[$value->product_id]->product_quantity,
                    'return_date' => date('d-M-y', strtotime($returnedproduct[$value->product_id]->return_date_and_time)),
                    'advance_amount' => $data['customer']->advance_payment,
                    'totalamount' => $totalBill,
                    'ReceivableAmount' => $reciveable,
                    'PayableAmount' => $payable
                );
            }
            // return $stock;
            return DataTables::of($stock)->make(true);
        }
        return view('admin.customer_lager_invoice.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['customer'] = CustomerRegisteration::all();
        $seal = Seal::where('customer_id', $request->customer_id)->get();
        if (request()->ajax()) {
            foreach ($seal as $key => $value) {
                $product_id = $value->product_id;
                $customer_id = $value->customer_id;
                $return[$value->id] = $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->where('customer_id', $customer_id)->get();
                $sal[$value->product_id] = $value;
                foreach ($data['returnedproduct'] as $val) {
                    $returnedproduct[$val->product_id] = $val;
                }
            }
            // return $seal;
            $stock[0] = 0;
            $indexes = null;
            $totalBill = 0;
            $payable = 0;
            $reciveable = 0;
            foreach ($seal as $key => $value) {
                $return[$value->id]= $sal[$value->product_id]->customer_id;
                $m[$value->product_id] = $data['customer'] = CustomerRegisteration::find($sal[$value->product_id]->customer_id);
                $data['product'] = Product::find($sal[$value->product_id]->product_id);
                if ($indexes > 1) {
                    $data['customer']->advance_payment = 0;
                }
                if (in_array($sal[$value->product_id]->customer_id, $return, TRUE)) {
                    $indexes++;
                }
                $total_q = $sal[$value->product_id]->product_quantity - $returnedproduct[$value->product_id]->product_quantity;
                // $totalBill += $bill = $total_q * $sal[$value->product_id]->product_seal_price;
                $totalBill += $bill = $sal[$value->product_id]->total_bill;

                if ($key == 0) {
                    $payable = $total = $bill - $data['customer']->advance_payment;
                } elseif ($payable > 0) {
                    $payable = $total = $payable - $bill;
                    if ($payable <= 0) {
                        $reciveable = $bill - $payable;
                        $payable = 0;
                    }
                } else {
                    $reciveable = $bill;
                    $payable = 0;
                }
                $Policies = Policies::find($value->policy_id);
                $stock[$key] = array(
                    'customer_id' => $data['customer']->customer_name,
                    'product_id' => $data['product']->product_name,
                    'product_quantity' => $sal[$value->product_id]->product_quantity,
                    'product_seal_price' => $sal[$value->product_id]->product_seal_price,
                    'created_at' => date('d-M-y', strtotime($sal[$value->product_id]->created_at)),
                    'policy_name' => $Policies->policy_name,
                    'policy_code' => $value->policy_code,
                    'policy_discount' => $value->policy_discount,
                    'credit_note' => $value->credit_note,
                    'total_quantity' => $total_q,
                    'bill' => $bill,
                    'return_product_quantity' => $returnedproduct[$value->product_id]->product_quantity,
                    'return_date' => date('d-M-y', strtotime($returnedproduct[$value->product_id]->return_date_and_time)),
                    'advance_amount' => $data['customer']->advance_payment,
                    'totalamount' => $totalBill,
                    'ReceivableAmount' => $reciveable,
                    'PayableAmount' => $payable
                );
            }
            // return $stock;
            return DataTables::of($stock)->make(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'customer_id' => 'required'
        ]);

        // $data['customer'] = CustomerRegisteration::all()
        // ->join('buy_policies','buy_policies.customer_id','');

        // with out query
        $data['customer'] = CustomerRegisteration::all();
        $seal = Seal::where('customer_id', $request->customer_id)->get();
        // if (request()->ajax()) {
        // foreach ($seal as $key => $value) {
        //     $product_id = $value->product_id;
        //     $customer_id = $value->customer_id;
        //     $return[$value->product_id] = $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->where('customer_id', $customer_id)->get();
        //     $sal[$value->product_id] = $value;
        //     foreach ($data['returnedproduct'] as $val) {
        //         $returnedproduct[$val->product_id] = $val;
        //     }
        // }
        // // return $seal;

        // $stock[0] = 0;
        // $indexes = null;
        // foreach ($seal as $key => $value) {
        //     $return[$value->product_id] = $sal[$value->product_id]->customer_id;
        //     $m[$value->product_id] = $data['customer'] = CustomerRegisteration::find($sal[$value->product_id]->customer_id);
        //     $data['product'] = Product::find($sal[$value->product_id]->product_id);
        //     $total_q = $sal[$value->product_id]->product_quantity - $returnedproduct[$value->product_id]->product_quantity;
        //     $bill = $total_q * $sal[$value->product_id]->product_seal_price;
        //     if ($key == 1) {
        //         if ($indexes <= 0) {
        //             $data['customer']->advance_payment = 0;
        //         }
        //     }
        //     $total = $data['customer']->advance_payment - $bill;
        //     if ($total <= 0) {
        //         $indexes = 0;
        //     }
        //     $stock[$key] = array('customer_id' => $data['customer']->customer_name, 'product_id' => $data['product']->product_name, 'product_quantity' => $sal[$value->product_id]->product_quantity, 'product_seal_price' => $sal[$value->product_id]->product_seal_price, 'created_at' => date('d-M-y', strtotime($sal[$value->product_id]->created_at)), 'total_quantity' => $total_q, 'bill' => $bill, 'return_product_quantity' => $returnedproduct[$value->product_id]->product_quantity, 'return_date' => date('d-M-y', strtotime($returnedproduct[$value->product_id]->return_date_and_time)), 'advance_amount' => $data['customer']->advance_payment, 'total' => $total);
        // }
        // return $stock;
        //     return DataTables::of($stock)->make(true);
        // }
        foreach ($seal as $key => $value) {
            $product_id = $value->product_id;
            $customer_id = $value->customer_id;
            $return[$value->id] = $data['returnedproduct'] = ReturnedProduct::where('product_id', $product_id)->where('customer_id', $customer_id)->get();
            $sal[$value->product_id] = $value;
            foreach ($data['returnedproduct'] as $val) {
                $returnedproduct[$val->product_id] = $val;
            }
        }
        // return $seal;
        $stock[0] = 0;
        $indexes = null;
        $totalBill = 0;
        $payable = 0;
        $reciveable = 0;
        foreach ($seal as $key => $value) {
            $return[$value->id]= $sal[$value->product_id]->customer_id;
            $m[$value->product_id] = $data['customer'] = CustomerRegisteration::find($sal[$value->product_id]->customer_id);
            $data['product'] = Product::find($sal[$value->product_id]->product_id);
            if ($indexes > 1) {
                $data['customer']->advance_payment = 0;
            }
            if (in_array($sal[$value->product_id]->customer_id, $return, TRUE)) {
                $indexes++;
            }
            $total_q = $sal[$value->product_id]->product_quantity - $returnedproduct[$value->product_id]->product_quantity;
            // $totalBill += $bill = $total_q * $sal[$value->product_id]->product_seal_price;
            $totalBill += $bill = $sal[$value->product_id]->total_bill;

            if ($key == 0) {
                $payable = $total = $bill - $data['customer']->advance_payment;
            } elseif ($payable > 0) {
                $payable = $total = $payable - $bill;
                if ($payable <= 0) {
                    $reciveable = $bill - $payable;
                    $payable = 0;
                }
            } else {
                $reciveable = $bill;
                $payable = 0;
            }
            $Policies = Policies::find($value->policy_id);
            $stock[$key] = array(
                'customer_id' => $data['customer']->customer_name,
                'product_id' => $data['product']->product_name,
                'product_quantity' => $sal[$value->product_id]->product_quantity,
                'product_seal_price' => $sal[$value->product_id]->product_seal_price,
                'created_at' => date('d-M-y', strtotime($sal[$value->product_id]->created_at)),
                'policy_name' => $Policies->policy_name,
                'policy_code' => $value->policy_code,
                'policy_discount' => $value->policy_discount,
                'credit_note' => $value->credit_note,
                'total_quantity' => $total_q,
                'bill' => $bill,
                'return_product_quantity' => $returnedproduct[$value->product_id]->product_quantity,
                'return_date' => date('d-M-y', strtotime($returnedproduct[$value->product_id]->return_date_and_time)),
                'advance_amount' => $data['customer']->advance_payment,
                'totalamount' => $totalBill,
                'ReceivableAmount' => $reciveable,
                'PayableAmount' => $payable
            );
        }
        return view('admin.customer_lager_invoice.PDF', compact('stock', 'data', 'seal'));
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
