<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Recipe extends Model
{
    protected $table = 'meal_recipe';
    protected $fillable = [

//    protected $table = 'meal_recipe';
//    protected $primaryKey = 'id';
//    protected $fillable = [
        'name','yields','also_known','chef','cook_time','cooking_type','description','dish_type', 'keeps_well','positive_point','prep_time','recipe_origin','serving_description', 'serving_size','directions','category','sub_category','sub_sub_category','tags','image','images','url_rewrite','meta_title','meta_desctiption','meta_tags','festivals','approved','cuisine_type','region','full_description','imagealt','imagetitle','thumb_image','recipe_unit','created_by','recipe_leftover','recipe_price','recurring_enable','leftover_enable', 'recipe_likes', 'per_serving_calories', 'meal_complexity_id', 'is_basic_food', 'type_seasonal_recipe','breakfast','main_dish','single_serving','taste'
        ];
   
    public function region(){
        return $this->hasOne('App\Models\Regions','id','region');
    }
    public function cuisine(){
        return $this->hasOne('App\Models\Cuisines','id','cuisine_type');
    }
    public function category(){
        return $this->hasOne('App\Models\RecipeCategory','id','category');
    }
    public function subcategory(){
        return $this->hasOne('App\Models\RecipeSubCategory','id','sub_category');
    }
    public function subsubcategory(){
        return $this->hasOne('App\Models\RecipeSubSubCategory','id','sub_sub_category');
    }
    public function ingredents(){
        return $this->hasMany('App\Models\RecipeIngredents','recipe_id');
        // return $this->belongsTo('App\Models\RecipeCategory','','category');
    }


    public function tags(){
        return $this->hasMany('App\Models\RecipeTags');
        // return $this->belongsTo('App\Models\RecipeCategory','','category');
    }
     public function blog(){
        return $this->belongsTo('App\Models\Blogs');
    }
      public function like(){
        return $this->hasMany('App\Models\DishLike','recipe_id');
    }
     public function recurring(){
        return $this->belongsTo('App\Models\UserRecurringFood');
    }
    public function primarydiettype(){
        return $this->hasMany('App\Models\RecipeDiettypeTags');
    }

        
    public function fromArray(){
        $array = parent::toArray();
        $array['ingredents'] = $this->ingredents()->get()->fromArray();
        return $array;
    }

   public function spintags(){
        return $this->hasMany('App\Models\SpiceinTag','ingredent_id');
       
    }
    public function mealsets(){
        return $this->hasMany('App\Models\RMealsettings','recipe_id');
       
    } 

public function products()
    {
        return $this->belongsToMany(ingredents::class)->withPivot(['quantity']);
    }
    

}
