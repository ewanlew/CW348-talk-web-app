<div class="post">
    <div class="post-header">
        <span class="post-author">{{ $post->user->name }}</span>
        <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <p><b>{{ $post->title }}</b></p>
    <p>{{ $post->content }}</p>
    <div class="post-footer">
        {{ $post->comments->count() }} comments
        @if (Auth::check())
            <button class="comment-button">Comment</button>
        @endif
    </div>
</div>
