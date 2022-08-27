<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model{
    protected $table = 'meal_reference';
    protected $fillable = [
        'persons_to_refer','per_person_benefit','referred_person_benefit','completion_check',
    ];
    
    
}
