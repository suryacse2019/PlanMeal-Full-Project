<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserGrocery extends Model
{    
    protected $table = 'meal_user_grocery';
    protected $fillable = [
        'user_id','ingred_id','grocery_start_date','grocery_end_date','amount','meal_unit','grocery_type', 'recipe_id', 'planner_recipe_pairing_id'
    ];

 	public static function validateIngredientWithGrocery($loggedIn, $ingred_id)
 	{
		$returnObj 		= DB::table('meal_user_grocery')
                        ->where('ingred_id', '=',$ingred_id)
                        ->where('user_id', '=', $loggedIn)
                        ->select('id', 'amount')->orderBy('id','DESC')->get();
        return $returnObj;
 	}
}