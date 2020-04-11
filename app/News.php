<?php

namespace App;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

class News
{
    private static $table = 'news';

    /**
     * @return array
     */
    public static function all(): array
    {
        return \DB::table(static::$table)->get()->all();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public static function one(int $id)
    {
        return \DB::table(static::$table)->find($id);
    }

    /**
     * @param int $category_id
     * @return array
     */
    public static function getByCategoryId(int $category_id): array
    {
        return \DB::table(static::$table)
            ->where('category_id', '=', $category_id)
            ->get()
            ->all();
    }
}
