<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMealplan extends Model{
    protected $table = 'meal_user_mealplan';
    protected $fillable = [
        'user_id','meal_name','meal_name_tag','cook_mode','meal_complexity','breakfast_food','meal_for_person','recurring_meal','available_time','recurring_food','nutrition_target_id','time_set'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    /*public function mealtime(){
        return $this->belongsTo('App\Models\UserMealtime','mealplan_id','id');
    }*/

    public function mealtime(){
        return $this->hasMany('App\Models\UserMealtime','mealplan_id','id');
    }
     public function recurring(){
        return $this->belongsTo('App\Models\UserRecurringFood');
    }
     public function mealleftover(){
        return $this->belongsTo('App\Models\UserLeftoverPattern');
    }
     public function leftoverto(){
        return $this->hasMany('App\Models\UserLeftoverTo','leftover_to');
    }
    
}
// ALTER TABLE `meal_user_mealplan`  ADD `nutrition_target_id` INT NULL DEFAULT NULL  AFTER `updated_at`;
// ALTER TABLE `meal_user_mealplan`  ADD `time_set` VARCHAR(255) NULL DEFAULT NULL  AFTER `nutrition_target_id`;