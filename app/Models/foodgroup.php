<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class foodgroup extends Model{
    protected $table = 'food_group';
    protected $fillable = [
        'name','approved','icon'
    ];
    public function foodgroup(){
        return $this->belongsTo('App\Models\foodgroup');
    }
   
}
