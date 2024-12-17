@extends('layouts.app')

@section('title', 'Timeline')

@section('content')
<div class="container mx-auto max-w-2xl mt-8">
    <!-- Notifications -->
    <div class="bg-gray-800 p-4 rounded mb-6 text-center text-white">
        You have 0 new notifications - <a href="#" class="text-blue-400">click here to view</a>
    </div>

    <!-- Post Input Section -->
    <div class="bg-gray-900 p-6 rounded mb-6">
        <h2 class="text-2xl font-bold text-white mb-4">Create a Post</h2>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <textarea name="content" placeholder="What's on your mind?" 
                      class="w-full p-3 rounded bg-gray-800 text-white" rows="3" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 mt-4 rounded hover:bg-blue-600">
                Post
            </button>
        </form>
    </div>

    <!-- Posts Section -->
    <div id="post-list">
        @foreach ($posts as $post)
            <div class="bg-gray-800 p-4 rounded mb-4">
                <div class="flex justify-between">
                    <span class="text-blue-400">{{ $post->user->name }}</span>
                    <span class="text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-white mt-2">{{ $post->content }}</p>
                <div class="mt-2 text-gray-400">
                    {{ $post->comments->count() }} comments
                    @if (Auth::check())
                        <button class="ml-4 text-blue-400 hover:text-blue-500">Comment</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
