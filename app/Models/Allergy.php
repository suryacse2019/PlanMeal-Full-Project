<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model{
    protected $table = 'meal_allergies';
    protected $fillable = [
        'name','allergy_category'
    ];
     public function allergycategory(){
        return $this->hasOne('App\Models\AllergyCategory','id','allergy_category');
    }
    
    
}
