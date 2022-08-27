<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostDish extends Model
{
	protected $table = 'post_dishes';
    protected $fillable = [
        'post_id','dishes_id'
    ];
    public function dish(){
        return $this->belongsTo('App\Models\Recipe','dishes_id');
    }
}
