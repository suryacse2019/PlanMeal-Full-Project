<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeFestival extends Model
{
	protected $table 		= 'meal_recipe_festival';
	
	protected $primaryKey 	= 'id';
    
    protected $fillable 	= ['recipe_id','festival_id'];

    
}
