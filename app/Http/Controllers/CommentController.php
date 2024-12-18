<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the comment input
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Create the comment and associate it with the post and user
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Redirect back to the post page with a success message
        return redirect()->route('posts.show', $post->id)
            ->with('success', 'Comment added successfully!');
    }
}
