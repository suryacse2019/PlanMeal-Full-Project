<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    
    protected $table = 'meal_tags';
    protected $fillable = ['name','description','approved','meal_tag_categories_id','color_code'];
    
    public function recipe(){
        return $this->belongsTo('App\Models\Recipe');
    }
    public function tags(){
    	return $this->hasOne('App\Models\Tags');
        // return $this->belongsTo('App\Models\Tags');
    }
}
