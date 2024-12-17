<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a list of posts
    public function index()
    {
        $posts = Post::with('user', 'comments')->paginate(10); // Add pagination
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('timeline')->with('success', 'Post created successfully.');
    }

    // Show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing a post
    public function edit(Post $post)
    {
        $this->authorizeAction($post);
        return view('posts.edit', compact('post'));
    }

    // Update a post in the database
    public function update(Request $request, Post $post)
    {
        $this->authorizeAction($post);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        $this->authorizeAction($post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Fetches 20 posts for timeline
    public function timeline(Request $request)
{
    $posts = Post::with('user', 'comments')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    if ($request->ajax()) {
        // Return each post as part of the AJAX request
        return view('posts._posts', ['posts' => $posts])->render();
    }

    return view('posts.timeline', compact('posts'));
}




    /**
     * Helper method to enforce role-based access.
     * Allows admins to edit/delete any post and users to edit/delete their own posts.
     *
     * @param Post $post
     * @return void
     */
    protected function authorizeAction(Post $post)
    {
        if (auth()->user()->isAdmin()) {
            return; // Admins can manage any post
        }

        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
