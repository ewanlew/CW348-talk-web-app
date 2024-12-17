@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl mt-8">
    <h1 class="text-3xl font-bold text-white mb-6">All Posts</h1>

    @foreach ($posts as $post)
        <div class="bg-gray-800 p-4 rounded mb-4">
            <div class="flex justify-between">
                <span class="text-blue-400">{{ $post->user->name }}</span>
                <span class="text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-white mt-2">{{ $post->content }}</p>
            <div class="mt-2 text-gray-400">
                {{ $post->comments->count() }} comments
            </div>
        </div>
    @endforeach

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
