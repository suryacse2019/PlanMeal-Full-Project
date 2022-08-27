<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergyCategory extends Model{
    protected $table = 'meal_allergies_category';
    protected $fillable = [
        'name'
    ];
   
     public function allery(){
        return $this->belongsTo('App\Models\Allergy');
    }
}
