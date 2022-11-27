<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [ 'product_id',  'product_code',  'purchase_price',  'purchase_expense','product_quantity',  'sale_expense',  'packing_expense',  'total_expense' ];

}
