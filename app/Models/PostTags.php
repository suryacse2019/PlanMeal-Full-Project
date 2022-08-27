<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTags extends Model
{
	protected $table = 'post_tag';
    protected $fillable = [
        'post_id','tag_id'
    ];
    public function tag(){
        return $this->belongsTo('App\Models\BlogTags','tag_id');
    }
}
