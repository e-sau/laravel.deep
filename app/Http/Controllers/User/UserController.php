<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $this->validate($request, User::rules(), [], User::attributeNames());

            $user = User::getUserByLogin($data['login']);

            if ($user && $user['password'] === $data['password']) {
                session(['auth' => true]);
                return redirect()->route('admin.index');
            }
        }

        return redirect()->route('auth.index');
    }

    public function logout()
    {
        session(['auth' => false]);
        return redirect()->back();
    }
}
