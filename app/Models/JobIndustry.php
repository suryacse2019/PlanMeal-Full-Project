<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobIndustry extends Model{
    protected $table = 'meal_job_industry';
    protected $fillable = [
        'title','description','image','status', 'slug'
    ];
    
    public function job(){
        return $this->belongsTo('App\Models\Jobs');
    }
}
