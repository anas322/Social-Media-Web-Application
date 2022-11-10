<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Profile_User extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'profile_user';



    
    //re-cache the count after createing or deleting a follow  
    public static function booted(){
        static::created(function ($follow){
            cache()->forget('count.following.' . $follow->profile($follow->profile_id));
            cache()->forget('count.followers.' . $follow->profile($follow->profile_id));
        });

        static::deleted(function ($follow){
            cache()->forget('count.following.' . $follow->profile($follow->profile_id));
            cache()->forget('count.followers.' . $follow->profile($follow->profile_id));
        });
    }

    //get the profile user_id
    public function profile($profile_id){
        $profile = Profile::findOrFail($profile_id) ;
        return $profile->user_id;
    }

}
