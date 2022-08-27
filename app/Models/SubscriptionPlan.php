<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model{
    protected $table = 'meal_subscription_plan';
    protected $fillable = [
        'title','description','time_limit','diet_plan','event_plan','price','subscription_type','grocery_export'
    ];
    
     public function userplan(){
        return $this->hasMany('App\Models\UserSubscription','subscribe_id');
    }
    /* public function userpaylog(){
        return $this->hasMany('App\Models\UserPaymentLog','subscribe_id');
    }*/
    
}
