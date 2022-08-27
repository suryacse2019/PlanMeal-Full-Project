<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AyurVeda extends Model
{
    protected $table = 'ayurveda';
    protected $fillable = ['name','color','description','approved','icon','Slug'];
    
    
}
