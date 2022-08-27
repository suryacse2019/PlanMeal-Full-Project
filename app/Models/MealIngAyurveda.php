<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealIngAyurveda extends Model{
    protected $table = 'meal_ingredient_ayurveda';
    protected $fillable = [
        'ingredients_id','ayurveda_id','active'
    ];

    public function setUpdatedAt($value)
    {
      return NULL;
    }
    
}
