<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurements extends Model
{
    protected $table = 'meal_measurements';
    protected $fillable = [
        'id','unit'
    ];
    
    public function measurement(){
        return $this->hasMany('App\Models\IngredentMeasurements','measurement_id');
    }
    public function measureunit(){
        return $this->hasMany('App\Models\RecipeIngredents','unit_measure');
    }

    public function RecipeIngredents(){
        return $this->belongsTo('App\Models\RecipeIngredents');
    }


}
