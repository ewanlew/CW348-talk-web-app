@extends('layouts.app')

@section('content')
<div>
    <h1>All Posts</h1>

    @foreach ($posts as $post)
        <div>
            <div>
                <span>{{ $post->user->name }}</span>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <p>{{ $post->content }}</p>
            <div>
                {{ $post->comments->count() }} comments
            </div>
        </div>
    @endforeach

    <!-- Pagination Links -->
    <div>
        {{ $posts->links() }}
    </div>
</div>
@endsection
