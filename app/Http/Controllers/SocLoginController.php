<?php

namespace App\Http\Controllers;

use App\Adaptors\AdaptorSoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocLoginController extends Controller
{
    public function requestGitHub()
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }

        return Socialite::with('github')->redirect();
    }

    public function responseGitHub(AdaptorSoc $adaptor)
    {
        if (Auth::check()) {
            return redirect()->route('Home');
        }

        $userOuter = Socialite::driver('github')->user();

        $user = $adaptor->getUser($userOuter, 'github');

        if ($user) {
            Auth::login($user);
            return redirect()->route('Home');
        }

        return redirect()->back()->with('error', 'Ошибка авторизации!');
    }
}
