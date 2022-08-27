<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApply extends Model{
    protected $table = 'meal_job_apply';
    protected $fillable = [
        'name','email','phone','experience','job_id','resume'
    ];
    
    
}
