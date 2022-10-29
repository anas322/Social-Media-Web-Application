<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;

class PostController extends Controller
{
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
        $post->delete();
        
        Storage::disk('public')->delete($post->image);

        return redirect()->route('prof.index',auth()->id());
    }

}
