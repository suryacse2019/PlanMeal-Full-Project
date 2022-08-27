<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientState extends Model{
    protected $table = 'meal_ingre_state';
    protected $fillable = [
        'state','description','approved','created_at', 'updated_at'
    ];
    
}
