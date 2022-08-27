<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeMealPlanSettings extends Model{
    protected $table = 'recipe_meal_plan_settings';
    protected $fillable = [
        'recipe_id','type_of_plan','category','sub_category'
    ];
}