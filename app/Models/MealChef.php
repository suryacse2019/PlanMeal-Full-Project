<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealChef extends Model{
    protected $table = 'meal_chef';
    protected $fillable = [
        'id','name','approved'
    ];
    
}
