<?php

namespace App\Http\Controllers\Admin\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        return view(
            'admin.news.index',
            [
                'news' => News::query()->paginate(6),
            ]
        );
    }

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

    protected function store($data)
    {
        $news = new News();
        $news->fill($data);

        if (!empty($data['image'])) {
            $path = Storage::putFile('public/images', $data['image']);
            $url = Storage::url($path);

            $news->image = $url;
        }

        $route = 'admin.news.index';

        if (!$news->save()) {
            $route = 'admin.news.create';
        }

        return redirect()->route($route)->with('success', 'Новость сохранена!');
    }

    public function edit(News $news)
    {
        return view(
            'admin.news.create',
            [
                'news' => $news,
                'categories' => Category::all()
            ]
        );
    }

    public function update(Request $request, News $news)
    {
        if ($request->isMethod('POST')) {
            $request->flash();

            $news->fill($request->all());

            if (!empty($request->file('image'))) {
                $path = Storage::putFile('public/images', $request->file('image'));
                $url = Storage::url($path);

                $news->image = $url;
            }

            if ($news->save()) {
                return redirect()->route('admin.news.index')->with('success', 'Новость обновлена!');
            }
        }

        return redirect()->back();
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->back()->with('success', 'Новость удалена!');
    }

    public function json()
    {
        return response()
            ->json(News::all())
            ->header('Content-Disposition', 'attachment; filename = "news.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
