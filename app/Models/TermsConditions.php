<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsConditions extends Model{
    protected $table = 'meal_terms_conditions';
    protected $fillable = [
        'title','description','main_description'
    ];
    
    
}
