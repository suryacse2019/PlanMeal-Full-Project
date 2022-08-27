<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class PlannerRecipePairing extends Model
{
    protected $table = 'meal_planner_recipe_pairing';
    protected $fillable = [
        'user_id','planner_day','mplan_id','no_of_recipe','planner_type','planner_date'
    ];

    public function get_dishes(){
        return $this->hasMany('App\Models\PlannerRecipePairingDishes','planner_pairing_id','id');
    }

    public static function getWeekPlannerDay($pairId)
    {
    	$getPlannerRecipeObj = DB::table('meal_planner_recipe_pairing')
    							->where('id', '=', $pairId)
    							->select(
    								'planner_day'
    							)
    							->get();
		return $getPlannerRecipeObj;
    }

    public static function getTotalMealPlanTarget($planner_day)
    {
        $getPlannerRecipeObj = DB::select(DB::raw("
                                    SELECT (SELECT SUM(calories) FROM meal_planner_recipe_pairing_dishes WHERE planner_pairing_id = meal_planner_recipe_pairing.id) as totalCalories
                                    FROM meal_planner_recipe_pairing
                                    WHERE 
                                        meal_planner_recipe_pairing.planner_day = '".$planner_day."'
                                    AND 
                                        user_id = ".Auth::id()."
                                "));
        $totalCalCount = 0;
        foreach($getPlannerRecipeObj as $item):
            $totalCalCount += $item->totalCalories;
        endforeach;
        return round($totalCalCount, 2);   
    }
}