<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisines extends Model{
    protected $table = 'meal_cuisine';
    protected $fillable = [
        'name'
    ];
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
     
}
