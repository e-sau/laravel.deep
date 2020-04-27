<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Orchestra\Parser\Xml\Facade as XMLParser;

class ParseController extends Controller
{
    public function index()
    {
        $xml = XMLParser::load('https://www.vedomosti.ru/newspaper/out/rss.xml');

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
        return Category::firstOrCreate([
            'title' => $title,
            'slug' => \Str::slug($title, '_')
        ]);
    }

    protected function fillNews($item, $category)
    {
        if (empty($item['title'])) return null;

        return News::firstOrCreate([
            'title' => $item['title'],
            'content' => !empty($item['description']) ? $item['description'] : '',
            'image' => !empty($item['enclosure::url']) ? $item['enclosure::url'] : '',
            'date' => !empty($item['pubDate']) ? date('Y-m-d', strtotime($item['pubDate'])) : date('Y-m-d'),
            'category_id' => $category
        ]);
    }
}
