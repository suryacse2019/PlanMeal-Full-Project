<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festivals extends Model
{
     protected $table = 'meal_festival';
     protected $fillable = ['name','holiday','description','festival_date'];
}
