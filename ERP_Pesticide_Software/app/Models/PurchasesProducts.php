<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesProducts extends Model
{
    use HasFactory;
    protected $table = 'purchases_products';
	protected $primaryKey = 'purchases_product_id';
    public $guarded=[];

}
