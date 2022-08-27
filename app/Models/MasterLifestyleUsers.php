<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLifestyleUsers extends Model

{
    protected $table = 'master_lifestyle_users';
    protected $fillable = [
        'type_of_form','name','email','mobile','height','weight','dob','gender','activity_level','ip_address'
    ];

}