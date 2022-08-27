<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLeftoverPattern extends Model{
    protected $table = 'meal_user_leftover_pattern';
    protected $fillable = [
        'user_id','meal_type','meal_type_leftover','day_to_keep','dishes_no','repeat_pattern','leftover_day','color_class'
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function mealleftovername(){
        return $this->hasOne('App\Models\UserMealplan','id','meal_type');
    }
    
    public function leftovertpattern(){
        return $this->hasMany('App\Models\UserLeftoverTo','leftover_id');
    }
    
}
