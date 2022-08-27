<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SavedPlans extends Model
{
    protected $table = 'meal_saved_plans';
    protected $fillable = [
        'user_id','planner_day','mplan_id','no_of_recipe','planner_type','planner_date','plan_name','plan_title','plan_description','c_time'
    ];

    public function get_saved_dishes(){
        return $this->hasMany('App\Models\SavedPlanDishes','saves_plan_id','id');
    }
}
