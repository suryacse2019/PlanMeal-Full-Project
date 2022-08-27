<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PMKeywords extends Model
{
    protected $table = 'meal_keywords';
    protected $fillable = [
        'category_id','category_id','keyword','approved'
    ];
    
public function pmkkword(){
        return $this->hasMany('App\Models\SeoPages','keyword');
    }


}
