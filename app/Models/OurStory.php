<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurStory extends Model{
    protected $table = 'meal_our_story';
    protected $fillable = [
        'title','description','image','banner'
    ];
    
    
}
