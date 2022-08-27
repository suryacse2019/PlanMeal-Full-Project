<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMealtimeNutritionTarget extends Model{
    protected $table = 'meal_user_mealtime_nutrition_target';
    protected $fillable = [
        'user_id','nutri_title','nutri_desc','nutri_calorie','carbs_min','carbs_max','fats_min','fats_max','pro_min','pro_max','limit_sodium','limit_chol','limit_fiber','carbs_precent','fats_percent','pro_percent','macro_range', 'sodium_min','sodium_max','cholestrol_min','cholestrol_max','fibre_min','fibre_max','num_meal_plan'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
     public function nutritiontargetday(){
        return $this->belongsTo('App\Models\UserMealtimeNutritionTargetDay');
    }
     public function nutritiontargetprofile(){
        return $this->belongsTo('App\Models\UserProfile');
    }
}
