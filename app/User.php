<?php

namespace App;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;

class User
{
//    use Notifiable;
    private const STORAGE_PATH = __DIR__ . '/../storage/user.json';


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

    public static function getDataFromDB()
    {
        try {
            $data = File::get(static::STORAGE_PATH);
        } catch (FileNotFoundException $e) {
            return [];
        }

        return json_decode($data, true);
    }

    /**
     * @param array $data
     * @return int|bool
     */
    public static function addDataToDb(array $data)
    {
        $dbData = static::getDataFromDB();
        $dbData[] = $data;

        return File::put(static::STORAGE_PATH,
            json_encode($dbData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
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
