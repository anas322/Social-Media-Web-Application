<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchUsersController extends Controller
{
    public function getUsers(Request $request){
        $name = $request->name;
        $users = User::where('name','like',"%{$name}%")->get();

        return response()->json(['users' => $users]);
    }
}
