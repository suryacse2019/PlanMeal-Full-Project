<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diseases extends Model
{
	protected $table 		= 'meal_diseases';
	
	protected $primaryKey 	= 'id';
    
    protected $fillable 	= ['name','symptoms','food_to_eaten','food_to_avoid','status'];

    
}
