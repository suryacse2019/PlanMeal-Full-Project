<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model{
    protected $table = 'meal_faq_category';
    protected $fillable = [
        'name','description','approved'
    ];
    
     public function question(){
        return $this->belongsTo('App\Models\FaqQuestions');
    }
}
