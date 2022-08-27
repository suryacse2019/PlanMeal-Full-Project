<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model{

    protected $table = 'meal_ingredient_category';
    protected $fillable = [
        'name','description','approved','icon', 'slug'
    ];

    public function ingredients(){
        return $this->hasMany(Ingredents::class, 'category');
    }
   
}
