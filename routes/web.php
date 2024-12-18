<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

// home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// guest routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// logout route
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// authenticated routes
Route::middleware(['auth'])->group(function () {
    // timeline
    Route::get('/timeline', [PostController::class, 'timeline'])->name('timeline');

    // view single post
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // store a new post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// show user profile
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// leave comment
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// delete comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


// db routes
Route::get('/usersdb', function () {
    return User::all();
});

Route::get('/postsdb', function () {
    return Post::all();
});

Route::get('/commentsdb', function () {
    return Comment::all();
});

// admin
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});