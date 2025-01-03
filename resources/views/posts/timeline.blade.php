@extends('layouts.app')

@section('title', 'Talk! Timeline')

@section('content')
<div class="container">
    <!-- Notifications -->
    <div class="notification-announcement">
        You have {{ $notificationCount }} 
        {{ $notificationCount === 1 ? 'notification' : 'notifications' }} -
        <a tabindex="5" href="{{ route('notifications') }}">click here to view</a>
    </div>


    <!-- Post Input Section -->
    <div class="create-post-div">
    <h2>Talk about something!</h2>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <textarea tabindex="6" class="title-entry" name="title" placeholder="Title" rows="1" required></textarea>
        <textarea tabindex="7" class="content-entry" name="content" placeholder="Whatcha talking about?" rows="3" required></textarea>
        <button tabindex="8" type="submit">Post</button>
    </form>
    </div>

    <!-- Posts Section -->
    <div id="post-list">
        @foreach ($posts as $post)
            @include('posts._post', ['post' => $post])
        @endforeach
    </div>

    <!-- Loading Spinner -->
    <div id="loading" style="display:none;">
        Loading more posts...
    </div>
</div>

 <script>
document.addEventListener("DOMContentLoaded", function () {
    let page = 2; 
    let loading = false; 
    let hasMorePosts = true;

    // Debounce scroll event
    let debounceTimer;
    window.addEventListener("scroll", function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            if (isNearBottom() && !loading && hasMorePosts) {
                fetchPosts();
            }
        }, 200); // 200ms
    });

    // Check if near the bottom
    function isNearBottom() {
        return window.innerHeight + window.scrollY >= document.body.offsetHeight - 200;
    }

    // Fetch more posts
    function fetchPosts() {
        loading = true;
        document.getElementById("loading").style.display = "block";

        fetch(`?page=${page}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" },
        })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "") {
                    hasMorePosts = false; // Stop when no more posts
                } else {
                    document.getElementById("post-list").insertAdjacentHTML('beforeend', data);
                    page++;
                }
                loading = false;
                document.getElementById("loading").style.display = "none";
            })
            .catch(() => {
                loading = false;
                hasMorePosts = false;
                document.getElementById("loading").style.display = "none";
            });
    }
});

</script>

@endsection
