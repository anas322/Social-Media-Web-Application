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

      $comment =  $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment_text' => request()->comment_text
        ]);

        $imagePath =  $comment->user->profile_photo_path ? asset('storage/' . $comment->user->profile_photo_path) : asset('storage') . '/default/default.png';
        $comment_created_at = $comment->created_at->diffForHumans();
        $comment_user_name = $comment->user->name;
        $comment_text = $comment->comment_text;
        return response()->json(['success'=>'submited with create comment','comment_text' => $comment_text,'comment_user_name' => $comment_user_name ,'comment_created_at' => $comment_created_at,'imagePath' => $imagePath]);
    }

     public function delete( ){
        $post = Post::find(request()->postId);
        
        $post->comments()->where('user_id' , auth()->id())->delete();

        return response()->json(['success'=>'submited with delete comment']);
    }
}
