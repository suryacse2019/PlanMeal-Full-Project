<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleDietPlan extends Model
{
    protected $table = 'meal_sample_plans table';
    protected $fillable = [
        'calories','group_id','type_id','description','slug','tag','image','PMEMNG','BRKFST','MIDMNG','PMLNCH', 'HGHTEA', 'PMSNCK', 'PMDINER', 'BEFBED','Foter_desc','approved','created_by','created_at','updated_at'
    ];
   
   /* public function category(){
        return $this->hasOne('App\Models\BlogCategory','id','category_id');
    }*/

    public function MealChef(){
        return $this->hasOne('App\Models\MealChef','id','name');
    }



      public function like(){
        return $this->hasMany('App\Models\BlogLike','post_id');
    }
    
    
}
