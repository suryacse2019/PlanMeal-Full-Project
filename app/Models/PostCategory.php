<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
	protected $table = 'post_category';
    protected $fillable = [
        'post_id','category_id'
    ];
    public function category(){
        return $this->belongsTo('App\Models\BlogCategory','category_id');
    }
    
}
