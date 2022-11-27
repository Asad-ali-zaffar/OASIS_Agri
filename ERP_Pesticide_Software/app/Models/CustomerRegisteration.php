<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRegisteration extends Model
{
    use HasFactory;
    protected $fillable = [ 'customer_name',  'father_name',  'CNIC',  'phone_number_one',  'phone_number_two',  'adress',  'advance_payment',  'panding_bill' ];
}
