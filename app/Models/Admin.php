<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'meal_admin';
    protected $fillable = [
        'username','password','password_reset_token'
    ];
}
