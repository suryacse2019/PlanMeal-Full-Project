<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishType extends Model{
    protected $table = 'meal_dish_type';
    protected $fillable = [
        'name','description'
    ];
    
}
