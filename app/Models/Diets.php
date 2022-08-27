<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diets extends Model
{
    protected $table = 'meal_primary_diet_type';
    protected $fillable = [
        'id','name','status'
    ];
}
