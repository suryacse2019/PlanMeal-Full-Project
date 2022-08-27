<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredentMeasurements extends Model
{
    protected $table = 'meal_ingredent_measurements';
    protected $fillable = [
        'ingredent_id','measurement_id','measure','temp1','temp2','price',
    ];
    
     public function measurementname(){
        return $this->hasOne('App\Models\Measurements','id','measurement_id');
    }
    public function ingredname(){
        return $this->hasMany('App\Models\Ingredents','id','ingredent_id');
    }
     public function measureunit(){
        return $this->belongsTo('App\Models\Measurements','unit_measure');
    }
    
    
}
