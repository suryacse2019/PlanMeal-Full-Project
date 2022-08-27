<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MRFrequency extends Model{
    protected $table = 'meal_recipe_Frequency';
    protected $fillable = [
        'id','name','days','approved'
    ];
    
}
