<div class="post">
<div class="post-header">
        <a href="{{ route('user.show', $post->user->id) }}" class="post-author">{{ $post->user->name }}</a>
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

        @if (Auth::check() && (Auth::user()->id === $post->user_id || Auth::user()->isAdmin()))
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
            </form>
        @endif
        
    </div>
</div>
