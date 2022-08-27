<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ingredents extends Model
{
    protected $table = 'meal_ingredents';
    protected $fillable = [
        'name','description','inayurveda','parameter','storage','shelf_life','is_healthy','image','calories','carbs','fats','protein','price','serving','food_group','per_gram_serving','fiber_in_gm','fiber_in_percent','sodium_in_mg','sodium_in_percent','potassium','cholesterol','water','yield','ayurveda_type','category','thumb_image','approved','directly_edible','created_by','also_known', 'url_rewrite', 'measurement_done', 'fat_sugar_done', 'vitamin_done', 'content_edit_check', 'complete'
    ];
    
    public function categoryName(){
        return $this->belongsTo(IngredientCategory::class, 'category', 'id');
    }

    public function spintags(){
        return $this->hasMany('App\Models\SpiceinTag','ingredent_id');
       
    }    
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
    public function fats(){
        return $this->belongsTo('App\Models\Fats');
    }
     public function sugars(){
        return $this->belongsTo('App\Models\Sugars');
    }
     public function vitamins(){
        // return $this->belongsTo('App\Models\VitaminsMinerals');
        return $this->hasOne('App\Models\VitaminsMinerals','id','ingredent_id');
    }
    public function ingquantity(){
        return $this->hasMany('App\Models\IngredentMeasurements','ingredent_id');
        // return $this->belongsTo('App\Models\RecipeCategory','','category');
    }
    
    public function fromArray(){
        $array = parent::toArray();
        $array['ingquantity'] = $this->ingquantity()->get()->fromArray();
        return $array;
    }

    public static function getIngredientsFromRecipe($recipe_id)
    {
        $getIngredientsObj = DB::select(DB::raw("
                                SELECT 
                                    meal_ingredents.name,
                                    meal_ingredents.url_rewrite,
                                    meal_ingredents.category,
                                    meal_ingredents.image,
                                    meal_ingredient_category.name AS categoryName,
                                    meal_recipe_ingredents.quantity,
                                    meal_measurements.unit,
                                    meal_ingredents.carbs,
                                    meal_ingredents.fiber_in_gm,
                                    meal_ingredents.protein,
                                    meal_ingredents.fats,
                                    meal_ingredents.calories,
                                    meal_ingredents.per_gram_serving,
                                    meal_ingredent_measurements.measure
                                FROM
                                    meal_recipe_ingredents
                                        LEFT JOIN
                                    meal_ingredents ON meal_recipe_ingredents.ingredent_id = meal_ingredents.id
                                        LEFT JOIN
                                    meal_ingredient_category ON meal_ingredents.category = meal_ingredient_category.id
                                        LEFT JOIN
                                    meal_measurements ON meal_recipe_ingredents.unit_measure = meal_measurements.id
                                        LEFT JOIN
                                    meal_ingredent_measurements ON meal_ingredents.id = meal_ingredent_measurements.ingredent_id
                                WHERE
                                    meal_recipe_ingredents.recipe_id = ".$recipe_id."
                                    AND
                                    meal_ingredent_measurements.measurement_id = meal_measurements.id
                                ORDER BY meal_ingredents.name ASC;
                            "));
        return $getIngredientsObj;
    }

}