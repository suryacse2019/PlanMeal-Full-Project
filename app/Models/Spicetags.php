<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spicetags extends Model{
    protected $table = 'spicetags';
    protected $fillable = [
        'name','tag','description','approved', 'is_featured', 'color' 
    ];
        
    public function sptags(){
        return $this->belongsTo('App\Models\Ingredents');
    }

    public function spintags(){
        return $this->hasOne('App\Models\Spicetags');
        // return $this->belongsTo('App\Models\Tags');
    }
}