<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRecipePairingDishes extends Model
{
    protected $table = 'meal_event_recipe_pairing_dishes';
    protected $fillable = [
        'recipe_pairing_id','dish_type','recipe_id','no_of_veg','no_of_nonveg'
    ];
}
