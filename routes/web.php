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

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Guest routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout route
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Timeline route
    Route::get('/timeline', [PostController::class, 'timeline'])->name('timeline');

    // Post routes
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Show user profile
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Comment routes
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Notifications route
Route::get('/notifications', [UserController::class, 'notifications'])
    ->name('notifications')
    ->middleware('auth');

// Database routes
Route::get('/usersdb', function () {
    return User::all();
});

Route::get('/postsdb', function () {
    return Post::all();
});

Route::get('/commentsdb', function () {
    return Comment::all();
});

// Admin routes
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('admin.posts.index');
});
