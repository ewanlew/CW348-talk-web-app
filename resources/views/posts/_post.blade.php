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
