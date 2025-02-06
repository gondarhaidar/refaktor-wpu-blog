<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'email:dns|required|unique:users',
            'password' => 'min:5'
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        return redirect('/login')->with('success', 'registration sucessfully');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'email:dns|required',
            'password' => 'required'
        ]);
        if(Auth::attempt($credentials)){
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('loginFailed', 'login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
