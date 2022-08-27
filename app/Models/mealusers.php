<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mealusers extends Model

{
    protected $table = 'meal_users';
    protected $fillable = [
        'name', 'email','phone','password','gender', 'd_o_b', 'city','facebook_id','twitter','pinterest', 'google_plus_id', 'tumbler','active','user_login_method','otp', 'verification_status', 'city','lname','invite_code','reference_code','forgot_token', 'is_generate_plan', 'ip_address', 'slug', 'meal_generate_limit','is_email_verified', 'email_verification_code'
    ];

}