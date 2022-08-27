<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MRtemprature extends Model{
    protected $table = 'meal_recipe_temprature';
    protected $fillable = [
        'id','name','approved'
    ];
    
}
