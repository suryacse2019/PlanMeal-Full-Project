<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRecipePairing extends Model
{
    protected $table = 'meal_event_recipe_pairing';
    protected $fillable = [
        'user_event_info_id','event_meal_id','recipe_cate_id','no_of_veg','no_of_nonveg'
    ];
}
