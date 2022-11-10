<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;


class LikeController extends Controller
{
    
    public function store( ){
        $post = Post::findOrFail(request()->postId);
        
        $post->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['success'=>'submited with like']);
    }

     public function delete( ){
        $post = Post::findOrFail(request()->postId);
        
        $post->likes()->where('user_id' , auth()->id())->delete();

        return response()->json(['success'=>'submited with unlike']);
    }
}
