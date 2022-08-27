<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiceInTag extends Model
{
	protected $table = 'spice_tag';
    protected $fillable = [
        'ingredent_id','spice_tag_id'
    ];
    public function spintag(){
        return $this->belongsTo('App\Models\Spicetags','spice_tag_id');
    }
}
 