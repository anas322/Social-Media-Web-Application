<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeMail;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function posts(){
       return $this->hasMany(Post::class);
    }

    public function following(){
        return $this->belongsToMany(Profile::class)->using(Profile_User::class)->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }


    //auto make a profile when the user registered and send a welcome mail
    public static function booted(){
        static::created(function ($user){
            $user->profile()->create([]);

            Mail::to($user->email)->send(new NewUserWelcomeMail($user));
        });
    }
}
