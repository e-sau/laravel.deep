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

    /**
     * @return array
     */
    public static function all(): array
    {
        return static::$category;
    }

    /**
     * @param $id
     * @return array|null
     */
    public static function one($id): ?array
    {
        return static::$category[$id] ?? null;
    }

    /**
     * @param $slug
     * @return int|null
     */
    public static function getIdBySlug($slug): ?int
    {
        $category = array_filter(static::$category, function ($item) use ($slug) {
            return $item['slug'] === $slug;
        });

        return key($category);
    }

    public static function getSlugById(int $id): ?string
    {
        return static::$category[$id]['slug'] ?? null;
    }

    public static function getTitleBySlug(string $slug): ?string
    {
        foreach (static::$category as $item) {
            if ($item['slug'] === $slug) return $item['title'];
        }

        return null;
    }
}
