<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade;

class ParseController extends Controller
{
    public function index()
    {
        $xml = Facade::load('https://www.vedomosti.ru/newspaper/out/rss.xml');

        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[title,description,enclosure::url,pubDate,category]']
        ]);

        foreach ($data['news'] as $item) {
            $category = $this->getCategory($item['category']);
            if (!$category) continue;

            $this->fillNews($item, $category->getKey());
        }

        return redirect()->route('admin.news.index');
    }

    protected function getCategory($title)
    {
        $category = Category::query()->where('title', $title)->first();

        if (!$category) {
            $newCategory = new Category();
            $newCategory->fill([
                'title' => $title,
                'slug' => \Str::slug($title, '_')
            ]);

            if ($newCategory->save()) {
                return $newCategory;
            } else {
                return null;
            }

        }

        return $category;
    }

    protected function fillNews($item, $category)
    {
        if (empty($item['title'])) return false;

        $news = News::query()->where('title', $item['title'])->first();

        if (!$news) {
            $newNews = new News();
            $newNews->fill([
                'title' => $item['title'],
                'content' => !empty($item['description']) ? $item['description'] : '',
                'image' => !empty($item['enclosure::url']) ? $item['enclosure::url'] : '',
                'date' => !empty($item['pubDate']) ? new \DateTime($item['pubDate']) : new \DateTime(),
                'category_id' => $category
            ]);

            $newNews->save();
        }
    }
}
