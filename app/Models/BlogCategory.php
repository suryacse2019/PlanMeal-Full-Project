<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model{
    protected $table = 'categories';
    protected $fillable = [
        'name','approved'
    ];
   
    public function blog(){
        return $this->belongsTo('App\Models\Blogs');
    }
   
    
}
