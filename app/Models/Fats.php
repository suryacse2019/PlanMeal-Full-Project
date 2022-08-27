<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fats extends Model
{
    protected $table = 'meal_fats';
    protected $fillable = [
        'ingredent_id','saturated_fat','mono_unsaturated_fat','poly_unsaturated_fat','trans_fat','omega_3_fatty_acid','omega_6_fatty_acid'
    ];
    
   public function fatsingredient(){
        return $this->hasOne('App\Models\Ingredents','id','ingredent_id');
    }
}
