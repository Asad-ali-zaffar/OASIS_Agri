<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    use HasFactory;
    protected $fillable = ['policy_name','policy_code','start_tenure_data','end_tenure_data','discount'];
}
