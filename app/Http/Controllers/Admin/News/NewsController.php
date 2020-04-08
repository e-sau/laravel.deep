<?php

namespace App\Http\Controllers\Admin\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->flash();

            return $this->store($request->all());
        }

        return view(
            'admin.news.create',
            [
                'categories' => Category::all(),
            ]
        );
    }

    protected function store($news)
    {
        $data = [
            'title' => $news['title'],
            'content' => $news['content'],
            'category_id' => (int) $news['category_id'],
            'date' => $news['date']
        ];

        $route = 'news.category.index';
        if (!News::addDataToDb($data)) {
            $route = 'admin.news.create';
        }

        return redirect()->route($route);
    }

    public function json()
    {
        return response()
            ->json(News::all())
            ->header('Content-Disposition', 'attachment; filename = "news.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
