<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTags extends Model{
    protected $table = 'tags';
    protected $fillable = [
        'name','tag','description','approved', 'is_featured'
    ];
    
    public function blog(){
        return $this->belongsTo('App\Models\Blogs');
    }
   
}
