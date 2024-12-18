@extends('layouts.app')

@section('title', 'Your Notifications')

@section('content')
<div class="container mx-auto max-w-2xl mt-8">
    <h1 class="text-2xl font-bold mb-6 text-white">Your Notifications</h1>

    @forelse ($notifications as $post)
        <div class="post mb-6">
            <div class="post-header">
                <p>
                    You have new comments on 
                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-400">
                        "{{ $post->title }}"
                    </a>
                </p>
                <span class="post-time">{{ $post->updated_at->diffForHumans() }}</span>
            </div>

            @foreach ($post->comments as $comment)
                @if ($comment->user_id !== auth()->id())
                    <div class="comment mt-2">
                        <p>
                            <b>{{ $comment->user->name }}</b> said: 
                            <span>{{ $comment->content }}</span>
                        </p>
                        <span class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    @empty
        <p class="text-gray-400">No new comments on your posts yet.</p>
    @endforelse
</div>
@endsection
