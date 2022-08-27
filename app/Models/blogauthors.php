<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blogauthors extends Model{
    protected $table = 'meal_author';
    protected $fillable = [
        'name','bio','facebook','twitter','linkedin','instagram','profile','pic','approved'
    ];
    public function blogauthors(){
        return $this->belongsTo('App\Models\blogauthors');
    }
   
}
