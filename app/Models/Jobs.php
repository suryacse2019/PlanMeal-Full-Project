<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'meal_jobs';
    protected $fillable = [
        'title','indus_id','description','content','job_status', 'slug'
    ];
   
    public function category(){
        return $this->hasOne('App\Models\JobIndustry','id','indus_id');
    }
    public function skills(){
        return $this->hasMany('App\Models\JobSkills','job_id');
       
    }
   
  
    
}
