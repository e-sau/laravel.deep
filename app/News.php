<?php

namespace App;

class News
{
    public static $news = [
        1 => [
            'id' => 1,
            'title' => 'Объявлен мир во всем мире',
            'content' => 'Сегодня, 23 марта 2020 года был провозглашен мир во всем мире. Ура, товарищи!',
            'category_id' => 1,
            'date' => '23.03.2020'
        ],
        2 => [
            'id' => 2,
            'title' => 'Российские ученые победили рак',
            'content' => 'Сегодня, 22 марта 2020 года российскими учеными был изобретен препарат, который уничтожает раковые клетки во всех их проявлениях и на любых стадиях. Ура, товарищи!',
            'category_id' => 1,
            'date' => '22.03.2020'
        ],
        3 => [
            'id' => 3,
            'title' => 'Колонизация Марса',
            'content' => 'Сегодня, 21 марта 2020 года российским космическим экипажем на корабле "Марс-1" была проведена успешная посадка на Марс. С этого дня началась эпоха колонизации Марса. Ура, товарищи!',
            'category_id' => 1,
            'date' => '21.03.2020'
        ],
        4 => [
            'id' => 4,
            'title' => 'Олимпийские игры в Антарктиде',
            'content' => 'Сегодня, российским спортсмены вернулись с Олимпийских игр в Антарктиде. Наша сборная выступила очень удачно, завоевав всё олимпийское золото, не оставив всех соперников позади себя в общем зачете Олимпиады. Это наша победа. Ура, товарищи!',
            'category_id' => 2,
            'date' => '21.03.2020'
        ],
    ];

    /**
     * @return array
     */
    public static function all(): array
    {
        return static::$news;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public static function one(int $id): ?array
    {
        return static::$news[$id] ?? null;
    }

    /**
     * @param int $category_id
     * @return array
     */
    public static function getByCategoryId(int $category_id): array
    {
        return array_filter(static::$news, function ($item) use ($category_id) {
            return $item['category_id'] === $category_id;
        });
    }
}
