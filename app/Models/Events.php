<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'meal_events';
    protected $fillable = [
        'name','description'
    ];
    
  public function eventinfo(){
        return $this->hasMany('App\Models\UserEvent','event_type_id');
    }
     
}
