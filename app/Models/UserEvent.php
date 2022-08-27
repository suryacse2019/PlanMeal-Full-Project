<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $table = 'meal_user_event';
    protected $fillable = [
        'event_type_id','event_name','event_desc','event_duration_type','event_duration','user_id','specific_event'
    ];
    
  public function event(){
        return $this->hasOne('App\Models\Events','id','event_type_id');
    }
      public function userinfo(){
        return $this->hasMany('App\Models\UserEventInformation','user_event_id');
    }
}
