<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model{
    protected $table = 'meal_region';
    protected $fillable = [
        'name','cusine_id'
    ];
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
     
}
