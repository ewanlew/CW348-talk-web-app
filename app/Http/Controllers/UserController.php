<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        $posts = Post::where('user_id', $id)->latest()->paginate(10); // Fetch user's posts

        return view('users.show', compact('user', 'posts'));
    }
}
