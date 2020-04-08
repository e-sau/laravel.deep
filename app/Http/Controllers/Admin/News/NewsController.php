<?php

namespace App\Http\Controllers\Admin\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->flash();

            if ($request->file('image')) {
                $a = $request;
            }

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
        if (!empty($news['image'])) {
            $path = Storage::putFile('public/images', $news['image']);
            $url = Storage::url($path);
        }

        $data = [
            'title' => $news['title'],
            'content' => $news['content'],
            'category_id' => (int) $news['category_id'],
            'image' => $url ?? null,
            'date' => $news['date']
        ];

        $route = 'news.category.index';

        if (!\DB::table('news')->insert($data)) {
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
