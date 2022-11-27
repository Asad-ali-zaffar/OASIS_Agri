<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedProduct extends Model
{
    use HasFactory;
    protected $fillable = [ 'customer_id',  'customer_phone_no' ,  'customer_CNiC' ,  'product_id' ,  'product_code',  'product_seal_price',  'delivery_charges', 'charges_amount', 'product_quantity','return_date_and_time','total_bill' ];
}

