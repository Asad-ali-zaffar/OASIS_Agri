<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSaleProduct extends Model
{
    use HasFactory;
    protected $table = 'return_sale_products';
	protected $primaryKey = 'id';
    public $guarded=[];
}
