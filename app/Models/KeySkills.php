<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeySkills extends Model{
    protected $table = 'meal_key_skills';
    protected $fillable = [
        'name','status'
    ];
    
    public function job(){
        return $this->belongsTo('App\Models\Jobs');
    }
   
}
