<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherSeo extends Model{
    protected $table = 'meal_otherseo';
    protected $fillable = [
        'name','page_url','author','page_title','page_description','keyword','follow','page_og_image','page_og_image_alt','page_og_title','page_og_desc','og_type','page_og_video','page_twitter_title','page_twitter_desc','page_twitter_image','page_twitter_alt'
    
    ];

    
   
}