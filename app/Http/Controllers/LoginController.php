<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['redirect_uri' => config('services.google.redirect')])
            ->redirect();
    }
    public function callback()
    {
        $userFromGoogle = Socialite::driver('google')->stateless()->user();
        $userFromDb = User::where('google_id', $userFromGoogle->getID())->first();

        if (!$userFromDb) {
            $userFromDb = new User();
            $userFromDb->email = $userFromGoogle->getEmail();
            $userFromDb->google_id = $userFromGoogle->getID();
            $userFromDb->name = $userFromGoogle->getName();
            $userFromDb->save();
            auth('web')->login($userFromDb);
            session()->regenerate();
            return redirect('/dashboard');
        }
        auth('web')->login($userFromDb);
        session()->regenerate();
        return redirect('/dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
