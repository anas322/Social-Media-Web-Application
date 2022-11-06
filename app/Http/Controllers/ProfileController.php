<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;

use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    
 public function index(User $user){

    $posts = Post::with(['likes','comments.user','user'])->where('user_id',$user->id)->orderBy('created_at','desc')->get();

    $assetUrl = asset('storage');
    
    $isFollow = auth()->user()->following->contains($user->profile);

    $postsCount = Cache::remember(
        'count.posts.'.$user->id,
        now()->addSeconds(20),
        function() use ($user){
        return $user->posts->count();
    });
        
    $followingCount = Cache::remember(
        'count.following.'.$user->id,
        now()->addSeconds(20),
        function() use ($user){
       return $user->following->count();
    });
    
     $followersCount = Cache::remember(
        'count.followers.'.$user->id,
        now()->addSeconds(20),
        function() use ($user){
        return $user->profile->followers->count();
    });

    $assetUrlProfile = asset('/images/profile');
    
        return Inertia::render('UserProfile/Profile', [ 
            'profile' => $user->profile ?? [] ,
            'userObject' => $user,
            'posts' => $posts,
            'assetUrl' => $assetUrl,
            'canEditProfile' => auth()->user()->can('update',$user->profile) ,
            'isFollow' =>$isFollow,
            'followingCount' => $followingCount,
            'followersCount' => $followersCount,
            'postsCount'     => $postsCount,
            'assetUrlProfile' => $assetUrlProfile
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

        $this->authorize('update',auth()->user()->profile);

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
