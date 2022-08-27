<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MealReportProblem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meal_report_problem';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ingredients_id', 'issue_related', 'suggestion_category', 'suggestion_description', 'name', 'mobile', 'email', 'otp', 'is_phone_verify', 'status'];

    
}
