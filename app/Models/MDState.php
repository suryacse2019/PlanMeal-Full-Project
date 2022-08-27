<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDState extends Model{
    protected $table = 'meal_dish_state';
    protected $fillable = [
        'id','name','description','approved'
    ];
    
}
