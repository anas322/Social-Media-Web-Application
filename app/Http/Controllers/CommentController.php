<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

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

        $comment_user_name = $comment->user->name;
        $comment_text = $comment->comment_text;
        return response()->json(['success'=>'submited with create comment','comment_text' => $comment_text,'comment_user_name' => $comment_user_name ,'comment_created_at' => $comment->created_at,'imagePath' => $imagePath,'id' => $comment->id]);
    }

     public function delete(){
        $id = request()->commentId;

        Comment::where('id',$id)->delete();

        return response()->json(['success'=>'submited with delete comment']);
    }
}
