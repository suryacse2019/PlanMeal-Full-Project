<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeDiettypeTags extends Model
{
	protected $table = 'meal_recipe_diet_type_tags';
    protected $fillable = [
        'recipe_id','diettype_id'
    ];
    public function diettype(){
        return $this->belongsTo('App\Models\PrimaryDietType','diettype_id');

        
    
    }
    
}
