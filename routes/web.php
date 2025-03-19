<?php

use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Models\Comment;


Route::get('/', function () {
    $posts = Post::with(['user'])->filter(request(['search', 'user']))->get();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});

Route::get('/posts', function () {
    $posts = Post::with(['user'])->filter(request(['search', 'user']))->get();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});
Route::get('/posts/{post:slug}', [function (Post $post) {
    $comments = Comment::where('post_id', $post->id)->get();
    return view('post', ['title' => 'Single Post', 'post' => $post, 'comments' => $comments]);
}]);

Route::get('/users/{user:id}', function (User $user) {
    // $posts = $user->posts->load('user', 'category');
    return view('posts', ['title' => $user->name, 'posts' => $user->posts]);
});
Route::view('/register', 'register', ['title' => 'Register page'])->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');
Route::view('/login', 'login', ['title' => 'Login page'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/redirect', [LoginController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/auth/callback', [LoginController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');
Route::resource('/blogs', PostController::class)->middleware('auth');
Route::post('/upload-image', [UploadController::class, 'upload']);

Route::post('/comment', [CommentController::class, 'store'])->middleware('auth');


