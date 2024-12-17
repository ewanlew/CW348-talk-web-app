@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <div class="profile-header mb-6">
        <h1 class="text-4xl font-bold text-white">{{ $user->name }}'s Profile</h1>
        <p class="text-gray-400">Joined: {{ $user->created_at->toFormattedDateString() }}</p>
    </div>

    <h2 class="text-2xl font-bold text-white mb-4">Posts by {{ $user->name }}</h2>

    @foreach ($posts as $post)
        <div class="post mb-6">
            <div class="post-header">
                <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <p><b>{{ $post->title }}</b></p>
            <p>{{ $post->content }}</p>
            <div class="post-footer">
                {{ $post->comments->count() }} comments
                @if (Auth::check())
                <button class="comment-button">View Comments</button>
                <button class="comment-button">Comment</button>
                @endif
            </div>
        </div>
    @endforeach

    {{ $posts->links() }} <!-- Pagination links -->
</div>
@endsection
