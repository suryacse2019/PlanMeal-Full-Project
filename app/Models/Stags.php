<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stags extends Model
{
    
    protected $table = 'spicetags';
    protected $fillable = ['name','tag','description','approved','color','is_featured','spice_tag_categories_id'];
    
    public function Ingredents(){
        return $this->belongsTo('App\Models\Ingredents');
    }
    public function Stags(){
    	return $this->hasOne('App\Models\Stags');
        
    }
}
