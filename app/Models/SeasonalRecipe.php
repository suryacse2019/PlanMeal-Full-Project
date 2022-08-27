<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeasonalRecipe extends Model{
    protected $table = 'meal_seasonal_recipe';
    protected $fillable = [
        'title','type_of_seasonal'
    ];
}