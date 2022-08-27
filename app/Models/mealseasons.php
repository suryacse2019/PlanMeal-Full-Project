<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mealseasons extends Model{
    protected $table = 'meal_seasons';
    protected $fillable = [
        'id','name'
    ];
    
}
