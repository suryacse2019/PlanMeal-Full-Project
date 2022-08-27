<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMealtime extends Model{
    protected $table = 'meal_user_mealtime';
    protected $fillable = [
        'user_id','mealplan_id','meal_time','meal_days','meal_day_type'
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function mealname(){
        return $this->hasOne('App\Models\UserMealplan','id','mealplan_id');
    }
    
}
