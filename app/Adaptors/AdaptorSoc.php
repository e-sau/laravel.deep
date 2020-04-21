<?php


namespace App\Adaptors;


use App\User;
use Laravel\Socialite\Two\User as UserOA;

class AdaptorSoc
{
    public function getUser(UserOA $userOuter, string $socname)
    {
        $userInner = $this->findUser($userOuter, $socname);

        if (!$userInner) {
            if ($this->findDuplicateEmail($userOuter)) {
                return redirect()->back()
                    ->with('error', 'Пользователь с таким email уже существует!');
            }

            if ($user = $this->saveUser($userOuter, $socname)) {
                return $user;
            } else {
                return redirect()->back()
                    ->with('error', 'Ошибка создания пользователя!');
            }
        }

        return $userInner;
    }

    public function findUser(UserOA $userOuter, string $socname)
    {
        return User::query()
            ->where('soc_id', $userOuter->id)
            ->where('auth_type', $socname)
            ->first();
    }

    public function findDuplicateEmail(UserOA $userOuter)
    {
        return User::query()
            ->where('email', $userOuter->email)
            ->first();
    }

    public function saveUser(UserOA $userOuter, string $socname)
    {
        $user = new User();

        if (empty($userOuter->getId()) || empty($userOuter->getEmail())) {
            return false;
        }

        $user->fill([
            'name'      => !empty($userOuter->getNickname()) ? $userOuter->getNickname() : '',
            'email'     => $userOuter->getEmail(),
            'password'  => '',
            'soc_id'    => $userOuter->getId(),
            'auth_type' => $socname,
            'avatar'    => !empty($userOuter->getAvatar()) ? $userOuter->getAvatar() : ''
        ]);

        if ($user->save()) {
            return $user;
        }

        return null;
    }
}
