<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDatabase extends Model{
    protected $table = 'meal_nutri_database';
    protected $fillable = [
        'database_name','data_desc','link','active'
    ];
    
}
