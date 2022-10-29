<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;

class ProfileController extends Controller
{
    
 public function index(User $user){

    $posts = Post::orderBy('created_at','desc')->get();
    $userPhotoUrl = $user->profile_photo_path ? asset('storage/'. $user->profile_photo_path) : asset('storage/default/default.png');

        return Inertia::render('UserProfile/Profile', [ 
            'profile' => $user->profile ,
            'posts' => $posts,
            'userPhotoUrl' => $userPhotoUrl 
         ]);     
        }   
    
    public function edit(User $user){
        $url = route("prof.update", $user);
        $profile = $user->profile ;
        return Inertia::render('UserProfile/Edit',[
            'url' =>$url,
            'profile' => $profile
        ]); 
    }

    public function update(Request $request){
      $validated =  $request->validate([
            'title' => 'nullable|string|max:65000',
            'description' => 'nullable|string|max:65000',
            'url' => 'nullable|url|required_with:url_text',
            'url_text' =>'nullable|string|max:255|required_with:url'
        ]);

        //if the user has a profile info it'll be updated otherwise it'll be created
        $method = (Profile::where('user_id',auth()->id())->get())->isEmpty() ? 'create' : 'update';
        

            auth()->user()->profile()->{$method}([
             'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'url_text' => $request->url_text,
            ]);
  

        return redirect()->route('prof.index',auth()->id());
    }

 
}
