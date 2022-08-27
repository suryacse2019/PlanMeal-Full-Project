<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserPantry extends Model
{    
    protected $table = 'meal_user_pantry';
    protected $fillable = [
        'user_id','grocery_id','amount','meal_unit','meal_quant','pantry_type', 'pantry_start_date', 'pantry_end_date', 'ingredients_id', 'recipe_id', 'planner_recipe_pairing_id'
    ];

    public static function validateIngredientWithGrocery($loggedIn, $ingred_id)
 	{
		$returnObj 		= DB::table('meal_user_pantry')
                        ->where('grocery_id', '=',$ingred_id)
                        ->where('user_id', '=', $loggedIn)
                        ->select('id', 'amount')->orderBy('id','DESC')->get();
        return $returnObj;
 	}
}