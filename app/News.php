<?php

namespace App;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

class News
{
    private const DB_FILENAME = 'news.json';

    public static function getDataFromDB()
    {
        try {
            $data = File::get(storage_path() . DIRECTORY_SEPARATOR . static::DB_FILENAME);
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

        return File::put(storage_path() . DIRECTORY_SEPARATOR . static::DB_FILENAME,
            json_encode($dbData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
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
