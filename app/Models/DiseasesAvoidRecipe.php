<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseasesAvoidRecipe extends Model
{
	protected $table 		= 'meal_diseases_avoid_recipe';
	
	protected $primaryKey 	= 'id';
    
    protected $fillable 	= ['diseases_id','recipe_id','type','status'];

    
}
