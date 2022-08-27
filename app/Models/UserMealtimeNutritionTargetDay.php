<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;

class UserMealtimeNutritionTargetDay extends Model{
    protected $table = 'meal_user_mealtime_nutrition_target_day';
    protected $fillable = [
        'user_id','nutrition_id','meal_day'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function nutritiontarget(){
        return $this->hasOne('App\Models\UserMealtimeNutritionTarget','id','nutrition_id');
    }
    
    public function get_recipe_pairing(){
        $uid = Auth::id();
        // print_r($uid);die;
        return $this->hasMany('App\Models\PlannerRecipePairing','planner_day','meal_day')
            ->where('user_id',$uid)
            /*->where(
                'user_id', 
                'user_id'
            )*/;
    }
}
