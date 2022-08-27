<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeSubCategory extends Model{
    protected $table = 'meal_recipe_sub_category';
    protected $fillable = [
        'recipe_category_id','main_category_id','sub_category_name','description','approved'
    ];
     public function category(){
        return $this->hasOne('App\Models\RecipeCategory','id','recipe_category_id');
    }
     public function subsubcategory(){
        return $this->belongsTo('App\Models\RecipeSubSubCategory');
    }
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
    
}
