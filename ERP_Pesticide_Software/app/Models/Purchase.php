<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [ 'product_id',  'product_code',  'purchasing_price',  'sealing_price',  'expiry_date',  'purchasing_expense',  'product_quantity'];

}
