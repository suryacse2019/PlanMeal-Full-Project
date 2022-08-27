<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    protected $table = 'role';
    protected $fillable = [
        'role_name','role_slug'
    ];
     

     public function User(){
        return $this->hasMany(User::class,  'id','role_id');
    }

    
}
