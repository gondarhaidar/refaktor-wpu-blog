<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
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
    $validateData['category_id'] = 1;

    $validateData['category_id'] = 1;

    Post::create($validateData);

    return redirect('/blogs')->with('success', 'Konten berhasil disimpan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
