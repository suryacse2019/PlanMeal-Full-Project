<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryForms extends Model{
    protected $table = 'meal_query_forms';
    protected $fillable = [
        'name','email','message','department'
    ];
    
    
}
