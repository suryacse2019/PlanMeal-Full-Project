<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mealrecipeunit extends Model{
    protected $table = 'meal_recipe_unit';
    protected $fillable = [
        'id','name'
    ];
    
}
