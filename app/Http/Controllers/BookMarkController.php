<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class BookMarkController extends Controller
{

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
