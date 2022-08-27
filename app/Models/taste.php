<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taste extends Model{
    protected $table = 'meal_food_taste';
    protected $fillable = [
        'name','approved'
    ];
   
}