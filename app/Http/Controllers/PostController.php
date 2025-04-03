<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function __construct()
    {
        if (Gate::denies('admin')) {
            abort(403, "Ngapain lu kesini.");
        }
    }
    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        return view('create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validateData = $request->validate([
        'title' => 'required',
        'slug' => 'required',
        'user_id' => 'required',
        'category_id' => 'required',
        'body' => 'required|string'
    ]);
    $originalSlug = Str::slug($validateData['slug']); // Pastikan slug bersih
    $slug = $originalSlug;
    $index = 2;

    while (Post::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $index;
        $index++;
    }

    $validateData['slug'] = $slug;
    $validateData['main_img'] = 'ODCgZAA83N0jQKR2NAmbhAQnlBqSjlTMfmIf1azz.png';

    Post::create($validateData);

    return redirect('/')->with('success', 'Postingan berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('edit', ['post' => $post]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'user_id' => 'required',
            'body' => 'required|string'
        ]);
        $originalSlug = Str::slug($validateData['slug']); // Pastikan slug bersih
        $slug = $originalSlug;
        $index = 2;
        
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $index;
            $index++;
        }
        
        $validateData['slug'] = $slug;
        $validateData['main_img'] = 'ODCgZAA83N0jQKR2NAmbhAQnlBqSjlTMfmIf1azz.png';
        
        Post::where('slug', $request->slug)->update($validateData);
        


        return redirect('/')->with('success', 'Berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Post::where('slug', $request->slug)->delete();

        return redirect('/')->with('success', 'Berhasil dihapus'); 
    }
}
