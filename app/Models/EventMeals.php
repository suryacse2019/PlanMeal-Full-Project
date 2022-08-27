<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMeals extends Model
{
    protected $table = 'meal_event_meals';
    protected $fillable = [
        'name','description'
    ];
    
     public function mealinfo(){
        return $this->hasMany('App\Models\UserEventInformation','mealtypee');
    }
    
}
