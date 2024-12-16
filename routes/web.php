<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/users', function () {
    return User::all();
});

Route::get('/posts', function () {
    return Post::all();
});

Route::get('/comments', function () {
    return Comment::all();
});

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/posts', [PostController::class, 'adminIndex']);
});

Route::middleware(['auth'])->group(function () {
    // Resource routes for posts
    Route::resource('posts', PostController::class);
});