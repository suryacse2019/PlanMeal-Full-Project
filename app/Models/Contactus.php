<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model{
    protected $table = 'meal_contactus';
    protected $fillable = [
        'username','useremail','userphone','usercompany','reason','message','status'
    ];
    
    
}
