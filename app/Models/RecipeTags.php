<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeTags extends Model
{
	protected $table = 'meal_recipe_tags';
    protected $fillable = [
        'recipe_id','tag_id'
    ];
    public function tag(){
        return $this->belongsTo('App\Models\Tags','tag_id');
    }
    //
}
