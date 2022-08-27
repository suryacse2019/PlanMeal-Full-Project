<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'meal_newsletter';
    protected $fillable = [
        'email','subscribe','subscribe_date','form_type', 'page_url','mobile','message', 'ip_address','misc'
    ];
   

    
}
