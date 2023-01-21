<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedProduct extends Model
{
    use HasFactory;

    protected $table = 'returned_products';
	protected $primaryKey = 'id';
    public $guarded=[];
    // protected $fillable = [ 'customer_id',  'customer_phone_no' ,  'customer_CNiC' ,  'product_id' ,  'product_code',  'product_Sale_price',  'delivery_charges', 'charges_amount', 'product_quantity','return_date_and_time','total_bill' ];
}

