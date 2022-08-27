<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model{
    protected $table = 'meal_news_item';
    protected $fillable = [
        'link','image','status'
    ];
    
    
}
