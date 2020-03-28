<?php

namespace App;

class Category
{
    public static $category = [
        1 => [
            'id' => 1,
            'title' => 'Политика',
            'slug' => 'politics',
        ],
        2 => [
            'id' => 2,
            'title' => 'Спорт',
            'slug' => 'sport',
        ],
    ];

    public static function all()
    {
        return static::$category;
    }

    public static function one($id)
    {
        return static::$category[$id];
    }

    public static function getIdBySlug($slug)
    {
        $category = array_filter(static::$category, function ($item) use ($slug) {
            return $item['slug'] === $slug;
        });

        return key($category) ?? -1;
    }
}
