<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explore extends Model{
    protected $table = 'meal_explore';
    protected $fillable = [
        'image','heading1','heading2','explore_status'
    ];
    
    
}
