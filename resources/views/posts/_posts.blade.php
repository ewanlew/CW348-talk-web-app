@foreach ($posts as $post)
    @include('posts._post', ['post' => $post])
@endforeach