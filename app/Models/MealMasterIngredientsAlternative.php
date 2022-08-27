<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealMasterIngredientsAlternative extends Model
{
    protected $table = 'meal_master_ingredients_alternative';
    protected $fillable = [
        'ingredients_id','alter_ingredients_id'
    ];
}