<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $errors = [];

        if ($request->isMethod('POST')) {
            if (Hash::check($request->post('password'), $user->password)) {
                $user->fill([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('newPassword')),
                    'email' => $request->post('email')
                ]);

                if ($user->save()) {
                    $request->session()->flash('success', 'Данные пользователя изменены!');
                } else {
                    $request->session()->flash('error', 'Ошибка обновления данных!');
                }
            } else {
                $errors['password'][] = "Текущий пароль указан неверно!";
            }
            return redirect()->route('profile.update')->withErrors($errors);
        }

        return view('profile.create', [
            'user' => $user
        ]);
    }

    public function toggleAdmin(Request $request)
    {
        $userId = ($request->body);

        $user = User::query()->find($userId);
        $user->is_admin = !$user->is_admin;

        if ($user && $user->save()) {
            return response()->json([
                'response' => 'OK',
                'message' => 'Права пользователя ' . $user->name . ' изменены!',
            ]);
        }

        return response()->json([
            'response' => 'ERROR',
            'message' => 'Ошибка обновления данных!'
        ]);
    }
}
