<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkills extends Model
{
	protected $table = 'meal_job_skills';
    protected $fillable = [
        'job_id','skill_id'
    ];
    public function skill(){
        return $this->belongsTo('App\Models\KeySkills','skill_id');
    }
}
