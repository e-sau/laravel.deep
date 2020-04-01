<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getDataFromDB(): array
    {
        $data = file_get_contents(__DIR__ . '/../database/user.json');

        return json_decode($data, true);
    }

    public static function addDataToDb(array $data): bool
    {
        $dbData = static::getDataFromDB();
        $dbData[] = $data;

        return file_put_contents(
            __DIR__ . '/../database/user.json',
            json_encode($dbData, JSON_PRETTY_PRINT)
        );
    }

    public static function getUserByLogin($login): ?array
    {
        foreach (static::getDataFromDB() as $user) {
            if ($user['login'] === $login) return $user;
        }

        return null;
    }
}
