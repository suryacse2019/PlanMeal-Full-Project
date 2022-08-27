<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientTags extends Model
{
	protected $table = 'spice_tag';
    protected $fillable = [
        'meal_ingredents_id','ingredent_id','spice_tag_id'
    ];
    public function stag(){
        return $this->belongsTo('App\Models\Spicetags','spice_tag_id');
    }
}
