<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->flash();

            return $this->store($request);
        }

        return view(
            'news.create',
            [
                'categories' => Category::all(),
            ]
        );
    }

    protected function store(Request $request)
    {
        $data = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'category_id' => (int) $request->post('category_id'),
            'date' => $request->post('date')
        ];

        $route = 'news.category.index';
        if (!News::addDataToDb($data)) {
            $route = 'news.create';
        }

        return redirect()->route($route);
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
