<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsCategory extends Model
{
    protected $table = 'meal_tag_categories';
    protected $fillable = ['name','color','approved','icon'];
    
    
}
