<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cookingtype extends Model{
    protected $table = 'meal_cooking_type';
    protected $fillable = [
        'name','description','approved'
    ];
    
}
