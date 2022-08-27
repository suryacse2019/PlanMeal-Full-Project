<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergies extends Model{
    protected $table = 'meal_allergies_category';
    protected $fillable = [
        'name','approved'
    ];
   
}