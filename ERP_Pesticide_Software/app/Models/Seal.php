<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seal extends Model
{
    use HasFactory;
    protected $fillable = [ 'customer_id',  'customer_phone_no' ,  'customer_CNiC' ,  'product_id' ,  'product_code',  'product_seal_price','policy_id','policy_code','policy_discount','credit_note',  'delivery_charges', 'charges_amount','recive_amount', 'product_quantity','total_bill' ];
}
