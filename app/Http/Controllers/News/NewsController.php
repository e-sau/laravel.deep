<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => News::all(),
        ]);
    }

    public function show($category, $id)
    {
        $news = News::one($id);

        if ($news === null) {
            return redirect()->route('news.index');
        }

        return view('news.show', [
            'news' => News::one($id)
        ]);
    }

    public function showByFilter($filter)
    {
        if ($filter['category_id']) {
            $news = News::getByCategoryId($filter['category_id']);

            if (!$news) {
                return redirect()->route('news.index');
            }

            return view('news.index', [
                'news' => News::getByCategoryId($filter['category_id'])
            ]);
        }
        return $this->index();
    }
}
