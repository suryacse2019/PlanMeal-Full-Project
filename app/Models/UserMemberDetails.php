<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class UserMemberDetails extends Model{
    protected $table = 'meal_user_family_members';
    protected $fillable = [
        'user_id','user_relation','membername','membernumber','memberemail','memberdob',
    ];
    
    public function relation(){
        return $this->hasOne('App\Models\UserRelations','id','user_relation');
    }
    
	public static function getTotalFamilyMemberCount()
   	{
   		$getTotalCount = DB::table('meal_user_family_members')
   							->where('user_id', '=', Auth::id())
   							->count();
		return $getTotalCount+1;
   	}   
}