<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
     
    public function store( ){
        request()->validate([
            'comment_text' => "required|max:5000"
        ]);

        $post = Post::find(request()->postId);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment_text' => request()->comment_text
        ]);

        return response()->json(['success'=>'submited with create comment']);
    }

     public function delete( ){
        $post = Post::find(request()->postId);
        
        $post->comments()->where('user_id' , auth()->id())->delete();

        return response()->json(['success'=>'submited with delete comment']);
    }
}
