<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VitaminsMinerals extends Model
{
    protected $table = 'meal_vitamins_minerals';
    protected $fillable = [
        'ingredent_id','vitamin_a','vitamin_b6	','vitamin_b12','vitamin_c','vitamin_d','vitamine_d2','vitamin_d3','vitamin_e','vitamin_k','calcium','iron','magnesium','phosphorus','zinc','copper','manganese','potassium','selenium','retinol','thiamine	','riboflavin','niacin','folate','choline','betaine','caffeine','lycopene','fluoride','water','calcium_in_percent','choline_in_percent','copper_in_percent','folate_in_percent','iron_in_percent','magnesium_in_percent','manganese_in_percent','niacin_in_percent','phosphorus_in_percent','riboflavin_in_percent','thiamine_in_percent','selenium_in_percent','vitamin_a_in_percent','vitamin_b6_in_percent','vitamin_b12_in_percent','vitamin_c_in_percent','calcium_in_percent','choline_in_percent','copper_in_percent','folate_in_percent','vitamin_d_in_percent','vitamin_e_in_percent','vitamin_k_in_percent','zinc_in_percent'
    ];
    public function vitaminsingredient(){
        return $this->hasOne('App\Models\Ingredents','id','ingredent_id');
    }
}
