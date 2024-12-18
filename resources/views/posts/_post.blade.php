<div class="post">
<div class="post-header">
        <a href="{{ route('user.show', $post->user->id) }}" class="post-author">{{ $post->user->name }}</a>
        <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>
    <div class="post-footer" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        {{ $post->comments->count() }} comments
        @if (Auth::check())
            <form method="GET" action="{{ route('posts.show', $post->id) }}" style="display: inline;">
                <button type="submit" class="comment-button">
                    View Comments
                </button>
            </form>

            <button class="comment-button">Comment</button>
        @endif
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
