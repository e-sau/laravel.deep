<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    protected $fillable = [
        'url'
    ];

    public $timestamps = false;

    public static function attributeNames()
    {
        return [
            'url' => 'Ссылка на RSS ленту',
        ];
    }
}
