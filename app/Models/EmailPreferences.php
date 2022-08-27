<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailPreferences extends Model{
    protected $table = 'meal_email_preferences';
    protected $fillable = [
        'name'
    ];
   
}
