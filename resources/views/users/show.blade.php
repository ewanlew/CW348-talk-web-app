@extends('layouts.app')

@section('title', 'Talk! ' . $user->name)
@section('content')
<div class="container mx-auto mt-8">
    <!-- header -->
    <div class="pc-div">
        <h1>{{ $user->name }}</h1>
        <p class="text-gray-400">Joined: {{ $user->created_at->toFormattedDateString() }}</p>
        <p>Total Posts: <span class="text-blue-400">{{ $totalPosts }}</span></p>
        <p>Total Comments: <span class="text-blue-400">{{ $totalComments }}</span></p>
    </div>


    <!-- tab nav -->
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="pc-div" style="display: flex; justify-content: center; gap: 20px; align-items: center; width: 50%;">
            <a tabindex="5" href="{{ route('user.show', ['id' => $user->id, 'tab' => 'posts']) }}" class="pc-view">
                Posts
            </a>
            <a tabindex="6" href="{{ route('user.show', ['id' => $user->id, 'tab' => 'comments']) }}" class="pc-view">
                Comments
            </a>
        </div>
    </div>


    <!-- content -->
    @if ($tab === 'posts')
        <h2 class="text-2xl font-bold text-white mb-4">Posts by {{ $user->name }}</h2>
        @forelse ($posts as $post)
            <div class="post mb-6">
                <div class="post-header">
                    <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <p><b>{{ $post->title }}</b></p>
                <p>{{ $post->content }}</p>
                <div class="post-footer" style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center;">
                        {{ $post->comments->count() }} {{ $post->comments->count() === 1 ? 'comment' : 'comments' }}
                        <form method="GET" action="{{ route('posts.show', $post->id) }}" style="margin-left: 10px;">
                            <button tabindex="0" type="submit" class="comment-button">Comments</button>
                        </form>
                    </div>
                    @if (Auth::check() && (Auth::user()->id === $post->user_id || Auth::user()->isAdmin()))
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button tabindex="0" type="submit" class="delete-button">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-400">No posts yet.</p>
        @endforelse
        {{ $posts->links() }}
    @else
        <h2>Comments by {{ $user->name }}</h2>
        @forelse ($comments as $comment)
        <div class="post" style="position: relative; padding-bottom: 40px;">
            <div class="post-header">
                <a tabindex="0" href="{{ route('posts.show', $comment->post->id) }}" class="post-author text-blue-400 hover:text-blue-500">
                    {{ $comment->post->title }}
                </a>
                <span class="post-time">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p>{{ $comment->content }}</p>

            @if (Auth::check() && (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()))
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" 
                    onsubmit="return confirm('Are you sure you want to delete this comment?');"
                    style="position: absolute; bottom: 10px; right: 10px; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">
                        Delete
                    </button>
                </form>
            @endif
        </div>

        @empty
            <p>No comments yet.</p>
        @endforelse
        {{ $comments->links() }}
    @endif
</div>
@endsection
