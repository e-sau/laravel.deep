<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'image', 'date', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function rules()
    {
        $categoryTable = (new Category())->getTable();

        return [
            'title' => 'required|min:5|max:100',
            'content' => 'required|min:10',
            'date' => 'required|date',
            'image' => 'mimes:jpeg,png|max:2000',
            'category_id' => 'exists:' . $categoryTable . ',id'
        ];
    }

    public static function attributeNames()
    {
        return [
            'title' => 'Заголовок',
            'content' => 'Текст',
            'category_id' => 'Категория'
        ];
    }
}
