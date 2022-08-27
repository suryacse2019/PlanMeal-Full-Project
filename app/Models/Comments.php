<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'name','email','comment','approved','post_id','posted_at'
    ];
   
    public function blog(){
        return $this->hasOne('App\Models\Blogs','id','post_id');
    }
    
    
}