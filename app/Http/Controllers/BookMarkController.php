<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\BookMark;

class BookMarkController extends Controller
{

    public function index(){
        //first get a pluck of post_id attached to the authenticated user and return all these posts;
        
        $arrayOfUserPostsId = BookMark::where('user_id' ,auth()->id())->pluck('post_id')->toArray();

        $posts = Post::whereIn('id',$arrayOfUserPostsId)->paginate(4);

        $userProfilePic = asset('storage') . '/'; 
        $userProfilePic .=  auth()->user()->profile_photo_path ? auth()->user()->profile_photo_path : 'default/default.png';

        return view('bookmarks.index',['posts' => $posts,'userProfilePic' =>$userProfilePic]);
    }

    public function store(){

        $post = Post::findOrFail(request()->postId);
        
        $post->bookmarks()->create([
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['success'=>'submited with bookmark']);
    }

     public function delete( ){
        $post = Post::findOrFail(request()->postId);
        
        $post->bookmarks()->where('user_id' , auth()->id())->delete();

        return response()->json(['success'=>'submited with delete bookmark']);
    }

}
