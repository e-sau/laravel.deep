<?php

namespace App;

class Category
{

    private static $table = 'category';

    /**
     * @return array
     */
    public static function all(): array
    {
        return \DB::table(static::$table)->get()->all();
    }

    /**
     * @param $id
     * @return array|null
     */
    public static function one($id): ?array
    {
        return \DB::table(static::$table)->find($id);
    }

    /**
     * @param $slug
     * @return int|null
     */
    public static function getIdBySlug($slug)
    {
        $result = \DB::table(static::$table)
            ->select(['id'])
            ->where('slug', '=', $slug)
            ->get()
            ->first();

        return $result ? $result->id : $result;
    }

    /**
     * @param int $id
     * @return string|null
     */
    public static function getSlugById(int $id)
    {
        $result = \DB::table(static::$table)
            ->select(['slug'])
            ->where('id', '=', $id)
            ->get()
            ->first();

        return $result ? $result->slug : $result;
    }

    /**
     * @param string $slug
     * @return string|null
     */
    public static function getTitleBySlug(string $slug)
    {
        $result = \DB::table(static::$table)
            ->select(['title'])
            ->where('slug', '=', $slug)
            ->get()
            ->first();

        return $result ? $result->title : $result;
    }
}
