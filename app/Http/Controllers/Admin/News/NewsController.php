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
            return $this->store($request);
        }

        return view(
            'admin.news.create',
            [
                'categories' => Category::all(),
            ]
        );
    }

    /**
     * @param Request $request
     * @param null|News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function store(Request $request, $news = null)
    {
        $successMessage = 'Новость обновлена!';

        if (!($news instanceof News)) {
            $news = new News();
            $successMessage = 'Новость добавлена!';
        }

        $data = $this->validate($request, News::rules(), [], News::attributeNames());

        $news->fill($data);

        if (!empty($request->file('image'))) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url = Storage::url($path);

            $news->image = $url;
        }

        if ($news->save()) {
            return redirect()->route('admin.news.index')->with('success', $successMessage);
        }

        $request->flash();
        return redirect()->route('admin.news.create');
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
        return $this->store($request, $news);
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
