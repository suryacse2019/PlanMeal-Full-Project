<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLeftoverTo extends Model{
    protected $table = 'meal_user_leftover_to';
    protected $fillable = [
        'leftover_id','leftover_to'
    ];
    
    public function userleftover(){
        return $this->hasOne('App\Models\UserLeftoverPattern','id','leftover_id');
    }
    
     public function mealplan(){
        return $this->hasOne('App\Models\UserMealplan','id','leftover_to');
    }
    
}
