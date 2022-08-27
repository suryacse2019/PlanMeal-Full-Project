<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmailPreferences extends Model{
    protected $table = 'meal_user_email_preferences';
    protected $fillable = [
        'mail_id','mail_type','user_id'
    ];
   
}
