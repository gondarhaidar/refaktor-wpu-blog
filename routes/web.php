<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    $posts = Post::with(['user'])->filter(request(['search', 'user', 'category']))->get();
    return view('posts', ['title' => 'Gondar blog', 'posts' => $posts]);
});


Route::view('/register', 'register', ['title' => 'Register page'])->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');
Route::get('/login', function(){
    return view('login', ['title' => 'gondar blog | login']);
})->name('login')->middleware('guest');
Route::get('/redirect', [LoginController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/auth/callback', [LoginController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::resource('/blogs', PostController::class)->except(['edit', 'edit'])->middleware('auth');
Route::get('/blogs/edit/{post:slug}', [PostController::class, 'edit'])->middleware('auth');
Route::put('/blogs/{post:slug}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/blogs/{post:slug}', [PostController::class, 'destroy'])->middleware('auth');
Route::post('/upload-image', [UploadController::class, 'upload'])->middleware('auth');

Route::post('/comment', [CommentController::class, 'store'])->middleware('auth');


Route::get('/{post:slug}', function (Post $post) {
    return view('post', ['post' => $post->load('comment.user')]);
});