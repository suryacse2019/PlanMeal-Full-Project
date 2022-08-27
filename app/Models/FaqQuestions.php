<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestions extends Model{
    protected $table = 'meal_faq_questions';
    protected $fillable = [
        'faqcate_id','question','answer','status'
    ];
     public function category(){
        return $this->hasOne('App\Models\FaqCategory','id','faqcate_id');
    }
   
    
}
