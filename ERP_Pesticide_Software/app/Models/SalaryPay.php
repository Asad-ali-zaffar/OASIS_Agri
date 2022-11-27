<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPay extends Model
{
    use HasFactory;
    protected $fillable=['employee_id','so_of','CNIC','designation','monthly_salary','total_monthly_expence','total_amount','status'];
}
