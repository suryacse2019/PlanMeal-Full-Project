<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SavedPlanDishes extends Model
{
    protected $table = 'meal_saved_plans_dishes';
    protected $fillable = [
        'saves_plan_id','recipe_id'
    ];

    public function saved_dish_pairing(){
        return $this->belongsTo('App\Models\SavedPlans','saves_plan_id','id');
    }
}
