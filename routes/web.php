<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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