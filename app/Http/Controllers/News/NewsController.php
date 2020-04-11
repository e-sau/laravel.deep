<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    public function show(Category $category, News $news)
    {
        return view('news.show', [
            'news' => News::query()->find($news->id)
        ]);
    }
}
