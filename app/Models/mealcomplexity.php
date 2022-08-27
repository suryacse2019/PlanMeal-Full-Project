<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mealcomplexity extends Model{
    protected $table = 'meal_complexity';
    protected $fillable = [
        'id','name'
    ];
    
}
