<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealType extends Model{
    protected $table = 'meal_type';
    protected $fillable = [
        'name','description','icon','approved', 'Slug' 
    ];
        


    public function mealsets(){
        return $this->hasOne('App\Models\MealType');
        // return $this->belongsTo('App\Models\Tags');
    }
}