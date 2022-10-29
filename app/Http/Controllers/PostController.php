<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

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

        return redirect()->route('profile.index',auth()->id());
    }
}
