<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEventInformation extends Model
{
    protected $table = 'meal_user_event_information';
    protected $fillable = [
        'name','event_date','meals','adult','child','event_time','place','user_event_id','mealtypee'
    ];
    
     public function eventmeal(){
        return $this->hasOne('App\Models\EventMeals','id','mealtypee');
    }
    
     public function userevent(){
        return $this->hasOne('App\Models\UserEvent','id','user_event_id');
    }
}
