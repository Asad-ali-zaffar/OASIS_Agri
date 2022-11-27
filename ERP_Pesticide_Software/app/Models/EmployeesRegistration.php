<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesRegistration extends Model
{
    use HasFactory;
    protected $fillable = [ 'employe_name',  'father_name',  'CNIC',  'phone_number_one',  'phone_number_two', 'address', 'territory' ,'designation',  'monthly_exprince','monthly_salary','status' ];
}
