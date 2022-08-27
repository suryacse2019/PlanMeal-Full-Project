<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaymentLog extends Model
{
    protected $table = 'meal_user_payment_log';
    protected $fillable = [
        'user_id','subscribe_id','pay_status','pay_amount','pay_datetime','razorpay_payment_id'
    ];
     
     /*public function user(){
        return $this->hasOne('App\User','id','user_id');
    } */
    
     public function subscription(){
        return $this->hasOne('App\Models\SubscriptionPlan','id','subscribe_id');
    }
     
}
