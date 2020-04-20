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

    public function setAdmin(Request $request, User $user)
    {
        $user->is_admin = 1;

        if ($user->save()) {
            $request->session()->flash(
                'success',
                'Теперь пользователь ' . $user->name . ' имеет права администратора!'
            );
        } else {
            $request->session()->flash('error', 'Ошибка обновления данных!');
        }

        return redirect()->back();
    }
}
