<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $user = User::getUserByLogin($request->post('login'));

        if ($user && $user['password'] === $request->post('password'))
        {
            session(['auth' => true]);
            return redirect()->route('home');
        }

        return redirect()->route('auth.index');
    }

    public function logout()
    {
        session(['auth' => false]);
        return redirect()->route('home');
    }
}
