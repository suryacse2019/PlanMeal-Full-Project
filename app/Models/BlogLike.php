<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    protected $table = 'meal_blog_like';
    protected $fillable = [
        'user_id','post_id','count_like'
    ];
    
     public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    
     public function post(){
        return $this->hasOne('App\Models\Blogs','id','post_id');
    }
    
     
}
