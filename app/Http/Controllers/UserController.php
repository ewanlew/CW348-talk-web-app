<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        $tab = $request->query('tab', 'posts'); // Default to 'posts'

        if ($tab === 'posts') {
            $posts = $user->posts()->with('comments')->latest()->paginate(10);
            $comments = null;
        } else {
            // Fetch comments made by the user and include the related post
            $comments = Comment::with('post')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->paginate(10);
            $posts = null;
        }

        return view('users.show', compact('user', 'tab', 'posts', 'comments'));
    }

    
}
