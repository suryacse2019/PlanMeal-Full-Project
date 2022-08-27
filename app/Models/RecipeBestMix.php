<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeBestMix extends Model
{
    protected $table = 'meal_recipe_best_mix';
    protected $fillable = [
        'recipe_id',
        'with_recipe_id',
    ];

    public $timestamps = false;
}
