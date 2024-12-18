<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * display user profile with posts or comments
     */
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        $tab = $request->query('tab', 'posts'); // default to 'posts'

        $totalPosts = $user->posts()->count();
        $totalComments = $user->comments()->count();

        if ($tab === 'posts') {
            $posts = $user->posts()->with('comments')->latest()->paginate(10);
            $comments = null;
        } else {
            // fetch comments made by the user and include the related post
            $comments = Comment::with('post')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->paginate(10);
            $posts = null;
        }

        return view('users.show', [
            'user' => $user,
            'totalPosts' => $totalPosts,
            'totalComments' => $totalComments,
            'tab' => request('tab', 'posts'),
            'posts' => $user->posts()->paginate(10),
            'comments' => $user->comments()->with('post')->paginate(10),
        ]);
    }

    /**
     * display notifications for the user
     */
    public function notifications()
    {
        $userId = auth()->id();

        $notifications = Post::with('comments.user')
            ->where('user_id', $userId)
            ->whereHas('comments', function ($query) use ($userId) {
                $query->where('user_id', '!=', $userId);
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('users.notifications', compact('notifications'));
    }
}
