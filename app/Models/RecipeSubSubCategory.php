<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeSubSubCategory extends Model
{
    protected $table = 'meal_recipe_sub_sub_category';
    protected $fillable = [
        'recipe_sub_category_id','sub_sub_category_name','description','approved'
    ];
    
     public function subcategory(){
        return $this->hasOne('App\Models\RecipeSubCategory','id','recipe_sub_category_id');
    }
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
    
}
