<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model{
    protected $table = 'meal_recipe_category';
    protected $fillable = [
        'name','description','approved','icon', 'slug'
    ];
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
     public function subcategory(){
        return $this->belongsTo('App\Models\RecipeSubCategory');
    }
}
