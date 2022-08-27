<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class PlannerRecipePairingDishes extends Model
{
    protected $table = 'meal_planner_recipe_pairing_dishes';
    protected $fillable = [
        'planner_pairing_id','recipe_id','per_serving_dish','calories'
    ];

    public function dish_pairing(){
        return $this->belongsTo('App\Models\PlannerRecipePairing','planner_pairing_id','id');
    }
    
    public function get_recipe(){
        return $this->belongsTo('App\Models\Recipe','recipe_id','id');
    }

    public static function getTotalMealPlanTypeCalories($pairId)
    {
        $getTotalSum = DB::table('meal_planner_recipe_pairing_dishes')
                        ->where('planner_pairing_id', '=', $pairId)
                        ->select(
                            DB::raw("SUM(calories) AS totalCalories")
                        )
                        ->get();
        return $getTotalSum[0]->totalCalories;
    }
}