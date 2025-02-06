<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});
// Route::get('/view', [ViewController::class, 'index']);
Route::get('/home', function () {
    return view('home', ['title' => 'Home']);
});
Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});
Route::get('/posts', function () {
    $posts = Post::with(['user'])->filter(request(['search', 'user']))->paginate(9)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});
Route::get('/users/{user:id}', function (User $user) {
    // $posts = $user->posts->load('user', 'category');
    return view('posts', ['title' => $user->name, 'posts' => $user->posts]);
});
Route::view('/register', 'register', ['title' => 'Register page'])->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');
Route::view('/login', 'login', ['title' => 'Login page'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');
Route::resource('/blogs', PostController::class)->middleware('auth');
Route::post('/upload-image', [UploadController::class, 'upload']);
