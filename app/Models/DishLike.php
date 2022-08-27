<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class DishLike extends Model
{
    protected $table = 'meal_dish_like';
    protected $fillable = [
        'user_id','recipe_id','dish_like','food_type'
    ];
    
     public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    
     public function recipe(){
        return $this->hasOne('App\Models\Recipe','id','recipe_id');
    }

    static public function getTotalCountRecipeLike($recipeId, $loggedId)
    {
        $getTotalCount  = DB::table('meal_dish_like')
                            ->where('user_id', '=', $loggedId)
                            ->where('dish_like', '=', 1)
                            ->where('food_type', '=', 1)
                            ->where('recipe_id', '=', $recipeId)
                            ->count();
        return $getTotalCount;
    }
}

// Food type = 1 : Recipe & 2 : Ingredients
// Dish like = 1 : Favorite & 2 : Blocked