<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDiseases extends Model
{
	protected $table 		= 'meal_users_diseases';
	
	protected $primaryKey 	= 'id';
    
    protected $fillable 	= ['diseases_id','user_id','status'];

    
}
