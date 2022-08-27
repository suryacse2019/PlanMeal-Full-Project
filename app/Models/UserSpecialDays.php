<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSpecialDays extends Model{
    protected $table = 'meal_user_special_days';
    protected $fillable = [
        'user_id','occasion','day'
    ];
    
   
    
   
}
