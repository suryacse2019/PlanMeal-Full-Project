<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model{
    protected $table = 'meal_user_profile';
    protected $fillable = [
        'user_id','diet_plan', 'i_want','gender','height_ft','height_in', 'weight_ft', 'bmi','dob_date','dob_month','dob_year', 'body_fat', 'activity','weight','weight_date','weight_month', 'weight_year', 'desire_weight','diet_type','substitution','price_limit','generator_focus','nutri_title','nutri_desc','nutri_calorie','carbs_min','carbs_max','fats_min','fats_max','pro_min','pro_max','limit_sodium','limit_chol','limit_fiber','carbs_precent','fats_percent','pro_percent','allergytag','macro_range','week_layout','nutrition_target_id','user_image','price_check','enable_leftover','grocery_dates','grocery_day', 'user_cuisine_type', 'ideal_weight', 'user_bmr','user_actual_bmr'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function nutritiontarget(){
        return $this->hasOne('App\Models\UserMealtimeNutritionTarget','id','nutrition_target_id');
    }
}
