<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'body' => 'required'
        ]);
        Comment::create($validateData);
        return back()->with('success', 'komentar terkirim');
    }
}
