<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPersonalDetails extends Model{
    protected $table = 'meal_user_personal_details';
    protected $fillable = [
        'user_id','special_days','user_festivals','member_details',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
