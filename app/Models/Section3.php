<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section3 extends Model{
    protected $table = 'meal_section3';
    protected $fillable = [
        'heading1','heading2','heading3','heading4','heading5','heading6','sec3_status','image1','image2','image3','image4','image5','image6'
    ];
    
    
}
