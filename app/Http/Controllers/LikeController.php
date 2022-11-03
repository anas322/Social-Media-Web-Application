<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;


class LikeController extends Controller
{
    
    public function store(Post $post ){

        $post->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['success'=>'submited with like']);
    }
}
