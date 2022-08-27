<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServingUnits extends Model{
    protected $table = 'meal_serving_units';
    protected $fillable = [
        'name','description'
    ];
    
}
