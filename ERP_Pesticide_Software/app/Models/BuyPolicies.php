<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPolicies extends Model
{
    use HasFactory;
    protected $fillable=['customer_id','customer_phone_no','address','policy_id','policy_code','start_tenure_data','end_tenure_data','discount','post_sale_incentive','cash_incentive','policy_incentives_status','cash_deposited','remaining_amount','credit_note'];
}
