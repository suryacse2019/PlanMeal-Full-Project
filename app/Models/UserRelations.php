<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRelations extends Model{
    protected $table = 'meal_user_relations';
    protected $fillable = [
        'name',
    ];
   
    public function relation(){
        return $this->belongsTo('App\Models\UserMemberDetails');
    }
    
    
}
