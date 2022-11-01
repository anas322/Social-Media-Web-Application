<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Profile;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index(){
        $usersId = auth()->user()->following->pluck('user_id');

        $posts = Post::whereIn('user_id',$usersId)->latest()->paginate(4);
        
        
        $userProfilePic = asset('storage') . '/';
        $userProfilePic .=  auth()->user()->profile_photo_path ? auth()->user()->profile_photo_path : 'default/default.png';

        return view('posts.index',[
            'posts' => $posts,
            'userProfilePic' =>$userProfilePic,
        ]);
    }


    public function create(){
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request){   
       //validate incomming post data 
       $data =  $request->validate([
            'caption' => 'required|string|max:65000',
            'image'   => 'required|image|mimes:jpg,jpeg,png|max:10000'
        ]);

        //store the image and return the path
        $path = $request->file('image')->store('posts','public');

        //store in the database if the data is validated
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $path
        ]);

        return redirect()->route('prof.index',auth()->id());
    }

    public function edit(Post $post){
        $imageUrl = asset('storage/' . $post->image);

        $editUrl = route('post.update',$post);

        return Inertia::render('Posts/Edit',[
            'post' =>$post,
            'imageUrl' => $imageUrl,
            'editUrl' => $editUrl
    ]);
    }

     public function update(Request $request ,Post $post){
        $this->authorize('update',$post);

        //validate incomming post data 
       $data =  $request->validate([
            'caption' => 'required|string|max:65000',
            'image'   => 'required|image|mimes:jpg,jpeg,png|max:10000'
        ]);

        Storage::disk('public')->delete($post->image);

        //store the new image and return the path
        $path = $request->file('image')->store('posts','public');

        $post->update([
            'caption' => $request->caption,
            'image' => $path
        ]);

      return redirect()->route('prof.index',auth()->id());
    }

    public function delete(Post $post){
        $this->authorize('delete',$post);

        $post->delete();

        Storage::disk('public')->delete($post->image);

        return redirect()->route('prof.index',auth()->id());
    }

}
