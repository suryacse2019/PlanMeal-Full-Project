<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealTips extends Model{
    protected $table = 'meal_tips';
    protected $fillable = [
        'tip_id','tip_srno','tiptitle','tipdesc','tipimg','tippage','tiptype','tipapproved'
    ];
   
}