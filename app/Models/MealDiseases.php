<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDiseases extends Model{
    protected $table = 'meal_diseases';
    protected $primaryKey='id';
    protected $fillable = [ 
        'name','symptoms','food_to_eaten','food_to_avoid','status'
    ];
    
    public function measure(){
        return $this->hasMany('App\Models\MealMasterIngredientsDisease','disease_id');
    }
    
}
