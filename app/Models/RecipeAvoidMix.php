<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeAvoidMix extends Model
{
    protected $table = 'meal_recipe_avoid_mix';
    protected $fillable = [
        'recipe_id',
        'avoid_with_recipe',
    ];

    public $timestamps = false;
}
