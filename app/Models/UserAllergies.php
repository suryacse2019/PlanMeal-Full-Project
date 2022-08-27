<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAllergies extends Model{
    protected $table = 'meal_user_allergies';
    protected $fillable = [
        'user_id','allergy_type', 'allergic_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    
   
}
