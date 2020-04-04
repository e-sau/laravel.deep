<?php

namespace App;

class News
{
    public static function getDataFromDB(): array
    {
        $data = file_get_contents(__DIR__ . '/../database/news.json');

        return json_decode($data, true);
    }

    public static function addDataToDb(array $data): bool
    {
        $dbData = static::getDataFromDB();
        $dbData[] = $data;

        return file_put_contents(
            __DIR__ . '/../database/news.json',
            json_encode($dbData, JSON_PRETTY_PRINT)
        );
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        return static::getDataFromDB();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public static function one(int $id): ?array
    {
        return static::getDataFromDB()[$id] ?? null;
    }

    /**
     * @param int $category_id
     * @return array
     */
    public static function getByCategoryId(int $category_id): array
    {
        return array_filter(static::all(), function ($item) use ($category_id) {
            return $item['category_id'] === $category_id;
        });
    }
}
