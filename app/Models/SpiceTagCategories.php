<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiceTagCategories extends Model
{
    protected $table = 'spice_tag_categories';
    protected $fillable = ['name','color','approved','icon'];
    
    
}
