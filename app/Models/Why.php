<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Why extends Model{
    protected $table = 'meal_why';
    protected $fillable = [
        'image','heading1','heading2','description'
    ];
    
    
}
