<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredents extends Model
{
	protected $table = 'meal_recipe_ingredents';
    protected $fillable = [
        'recipe_id','ingredent_id','meal_ingre_state','is_main_ingredien','in_order','notify','section_id','quantity','unit_measure','updated_at'
    ];
    public function ingredent(){
        return $this->belongsTo('App\Models\Ingredents','ingredent_id');
    }
    
    public function recipename(){
        return $this->hasOne('App\Models\Recipe','id','recipe_id');
    }
    public function measurename(){
        return $this->belongsTo('App\Models\Measurements','unit_measure');
    }
    
    public function Measurements(){
        return $this->hasMany('App\Models\IngredentMeasurements','ingredent_id','ingredent_id');
    }
    
    public function fromArray(){
        $array = parent::toArray();
        $array['ingredent'] = $this->ingredent()->get()->fromArray();
        return $array;
    }
}
