<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table = 'meal_user_subscription';
    protected $fillable = [
        'user_id','subscribe_id','status','start_date','end_date'
    ];
     
     /*public function user(){
        return $this->hasOne('App\User','id','user_id');
    } */
    
     public function subscription(){
        return $this->hasOne('App\Models\SubscriptionPlan','id','subscribe_id');
    }
     
}
