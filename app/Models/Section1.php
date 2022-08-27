<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section1 extends Model{
    protected $table = 'meal_section1';
    protected $fillable = [
        'heading1','heading2','heading3','sec1_status','banner'
    ];
    
    
}
