@extends('layouts.app')

@section('title', 'Talk! ' . $post->user->name . ': ' . $post->title)

@section('content')
<div class="container mx-auto max-w-2xl mt-8">
    <!-- nav -->
    <div style="margin-bottom: 10px;">
        <a href="{{ route('timeline') }}">← Back to Timeline</a>
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
        <div></div>

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
    <div class="comments">
    <h3>Comments</h3>
    @forelse ($post->comments as $comment)
        <div class="post">
            <div class="post-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <a href="{{ route('user.show', $comment->user->id) }}" class="post-author">
                        {{ $comment->user->name }}
                    </a>
                    <span class="post-time">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                
                <!-- delete comment -->
                @if (Auth::check() && (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()))
                    <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                @endif
            </div>
            <p>{{ $comment->content }}</p>
        </div>
    @empty
        <p>No comments yet, want to talk about something?</p>
    @endforelse
</div>


</div>
@endsection
