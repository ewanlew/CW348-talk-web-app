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
            @include('posts._post', ['post' => $post])
        @endforeach
    </div>

    <!-- Loading Spinner -->
    <div id="loading" class="text-center text-gray-400 mt-6" style="display:none;">
        Loading more posts...
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let page = 2; // Start loading from page 2
    let loading = false;

    window.addEventListener("scroll", function () {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && !loading) {
            loading = true;
            document.getElementById("loading").style.display = "block";

            fetch(`?page=${page}`, {
                headers: { "X-Requested-With": "XMLHttpRequest" },
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("post-list").insertAdjacentHTML('beforeend', data);
                page++;
                loading = false;
                document.getElementById("loading").style.display = "none";
            })
            .catch(() => {
                loading = false;
                document.getElementById("loading").style.display = "none";
            });
        }
    });
});
</script>
@endsection
