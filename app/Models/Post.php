<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


    //re-cache the count after createing new post or delete new one 
    protected static function booted(){
        static::created(function ($post){
            cache()->forget('count.posts.' . $post->user->id);
        });

        static::deleted(function ($post){
            cache()->forget('count.posts.' . $post->user->id);
        });
    }
}
