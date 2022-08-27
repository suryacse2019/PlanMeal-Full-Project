<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealMasterIngredientsDisease extends Model
{
    protected $table = 'meal_master_ingredients_disease';
    protected $primaryKey='id';
    protected $fillable = [
        'ingredients_id','disease_id'
    ];
    
    public function ingredename(){
        return $this->hasMany('App\Models\MealDiseases','ingredients_id','id');
    }
    public function measurement(){
        return $this->hasOne('App\Models\MealDiseases','id','disease_id');
    }
}
