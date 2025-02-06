<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $path = $request->file('image')->store('uploads', 'public'); // Simpan ke storage/public/uploads
        $url = asset('storage/' . $path); // Buat URL gambar

        return response()->json(['success' => true, 'image_url' => $url]);
    }
}
