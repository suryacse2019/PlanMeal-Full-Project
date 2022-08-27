<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model{
    protected $table = 'meal_footer';
    protected $fillable = [
        'copyright','banner'
    ];
    
    
}
