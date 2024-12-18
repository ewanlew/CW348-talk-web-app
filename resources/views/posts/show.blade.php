@extends('layouts.app')

@section('title', 'View Post')

@section('content')
<div class="container mx-auto max-w-2xl mt-8">
    <!-- nav -->
    <div style="margin-bottom: 10px;">
        <a href="{{ route('timeline') }}" class="text-blue-400 hover:text-blue-500">← Back to Timeline</a>
    </div>

    <!-- post -->
    <div class="post">
        <div class="post-header">
            <a href="{{ route('user.show', $post->user->id) }}" class="post-author">{{ $post->user->name }}</a>
            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
        </div>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <div class="post-footer" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            {{ $post->comments->count() }} {{ $post->comments->count() === 1 ? 'comment' : 'comments' }}
        </div>

        @if (Auth::check() && (Auth::user()->id === $post->user_id || Auth::user()->isAdmin()))
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Delete</button>
            </form>
        @endif
    </div>

    </div>

    <div class="post">
        <h3>Leave a comment:</h3>
        <form method="POST" action="{{ route('comments.store', $post->id) }}">
            @csrf
            <textarea name="content" placeholder="What do you want to say?" rows="3" class="content-entry"></textarea>
            <button type="submit" class="comment-button">Comment</button>
        </form>
    </div>

    <!-- comments -->
    <div class="comments mt-8">
        <h3 class="text-lg font-bold mb-4 text-white">Comments</h3>
        @forelse ($post->comments as $comment)
            <div class="post">
                <div class="post-header">
                    <a href="{{ route('user.show', $comment->user->id) }}" class="post-author">
                        {{ $comment->user->name }}
                    </a>
                    <span class="post-time">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p>{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-gray-400">No comments yet, want to talk about something?</p>
        @endforelse
    </div>

</div>
@endsection
