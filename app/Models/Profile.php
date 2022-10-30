<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

      protected $fillable = [
        'title',
        'description',
        'url',
        'url_text',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(App\Models\User::class);
    }

     public function followers(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
