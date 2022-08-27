<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryDietType extends Model{
    protected $table = 'meal_primary_diet_type';
    protected $fillable = [
        'name', 'status'
    ];
}