<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecurringFood extends Model{
    protected $table = 'meal_user_recurring_food';
    protected $fillable = [
        'recipe_id','user_id','mealplan_id','frequency','amount','meal_unit','gram_size', 'secondunit_size','food_type'
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function mealname(){
        return $this->hasOne('App\Models\UserMealplan','id','mealplan_id');
    }
    public function recipename(){
        return $this->hasOne('App\Models\Recipe','id','recipe_id');
    }
    
}
