<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sugars extends Model
{
    protected $table = 'meal_sugars';
    protected $fillable = [
        'ingredent_id','sugar','sucrose','glucose','fructose','lactose','maltose','glactose'
    ];
    public function sugarsingredient(){
       return $this->hasOne('App\Models\Ingredents','id','ingredent_id');
    }
}
