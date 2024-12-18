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
        $post->load('user', 'comments'); // Load post along with its user and comments
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
    // allow only the post owner or an admin to delete the post
    if (auth()->user()->id !== $post->user_id && !auth()->user()->isAdmin()) {
        abort(403, 'You are not authorized to delete this post.');
    }

    $post->delete();

    return redirect('/timeline')->with('success', 'Post deleted successfully.');
}

    // 10 posts for timeline
    public function timeline(Request $request)
{
    $posts = Post::with('user', 'comments')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    if ($request->ajax()) {
        // Return only the content for the next page
        return view('posts._posts', ['posts' => $posts])->render();
    }

    $user = auth()->user();
    $notificationCount = \App\Models\Comment::whereHas('post', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->where('updated_at', '>', $user->last_visited_at ?? now()->subDay())->count();

    return view('posts.timeline', [
        'posts' => $posts,
        'notificationCount' => $notificationCount,
    ]);
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
