<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealIngrestate extends Model
{
    protected $table = 'meal_ingre_state';
    protected $fillable = [
        'id','state','description','approved'
    ];
    
    public function RecipeIngredents(){
        return $this->belongsTo('App\Models\RecipeIngredents');
    }


}
