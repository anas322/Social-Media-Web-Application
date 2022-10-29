<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    
 public function index(User $user){

    $posts = Post::orderBy('created_at','desc')->get();

        return Inertia::render('Profile', [ 
            'profile' => $user->profile,
            'posts' => $posts
         ]);     
    }   

 
}
