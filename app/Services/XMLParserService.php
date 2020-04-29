<?php

namespace App\Services;

use App\Category;
use App\News;
use Orchestra\Parser\Xml\Facade as XMLParser;

class XMLParserService
{
    public function saveNews($link)
    {
        try {
            $xml = XMLParser::load($link);
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'news' => ['uses' => 'channel.item[title,description,enclosure::url,pubDate,category]']
            ]);
        } catch (\Exception $e) {
            return false;
        }

        foreach ($data['news'] as $item) {
            $category = $this->getCategory($item['category'] ?? $data['title']);
            if (!$category) continue;

            $this->fillNews($item, $category->getKey());
        }

        \Storage::disk('newsLogs')->append('log_news.txt', date('c') . ' ' . $link);

        return true;
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
