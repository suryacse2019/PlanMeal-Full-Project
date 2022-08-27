<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMealMenu extends Model
{
    protected $table = 'meal_event_meal_menu';
    protected $fillable = [
        'name',
    ];
}
