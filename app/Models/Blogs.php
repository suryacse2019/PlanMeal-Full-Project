<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title','slug','image','blog_author','short_desc','body','seo_title','seo_description','seo_tags','blog_status','thumb_image', 'image_title', 'image_alt_tag', 'prefered_blog', 'keyword','facebook_img','twitter_img','linkedin_img','sort_order','image_2','updated_at'  
    ];
   
   /* public function category(){
        return $this->hasOne('App\Models\BlogCategory','id','category_id');
    }*/

    public function blogauthors(){
        return $this->hasOne('App\Models\blogauthors','id','name');
    }

    public function categories(){
        return $this->hasMany('App\Models\PostCategory','post_id');
    }
    public function tags(){
        return $this->hasMany('App\Models\PostTags','post_id');
       
    }
     public function comment(){
        return $this->hasMany('App\Models\Comments','post_id');
    }
    
      public function like(){
        return $this->hasMany('App\Models\BlogLike','post_id');
    }
    public function dishes(){
        return $this->hasMany('App\Models\PostDish','post_id');
       
    }
    
}
