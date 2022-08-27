<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section2 extends Model{
    protected $table = 'meal_section2';
    protected $fillable = [
        'heading1','heading2','heading3','sec2_status','image','banner'
    ];
    
    
}
