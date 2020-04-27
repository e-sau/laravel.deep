<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug'
    ];

    public $timestamps = false;

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
        ];
    }

    public static function attributeNames()
    {
        return [
            'title' => 'Название категории',
        ];
    }
}
