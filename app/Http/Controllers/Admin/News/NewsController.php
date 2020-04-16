<?php

namespace App\Http\Controllers\Admin\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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

    /**
     * @param Request $request
     * @return Application|Factory|RedirectResponse|View
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            if ($this->store($request)) {
                return redirect()->route('admin.news.index')->with('success', 'Новость добавлена!');
            } else {
                $request->flash();
                return redirect()->route('admin.news.create');
            }
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
     * @param null $news
     * @return bool
     * @throws ValidationException
     */
    protected function store(Request $request, $news = null)
    {
        if (!($news instanceof News)) {
            $news = new News();
        }

        $data = $this->validate($request, News::rules(), [], News::attributeNames());

        $news->fill($data);

        if (!empty($request->file('image'))) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $url = Storage::url($path);

            $news->image = $url;
        }

        return $news->save();
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

    /**
     * @param Request $request
     * @param News $news
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, News $news)
    {
        if ($this->store($request, $news)) {
            return redirect()->route('admin.news.index')->with('success', 'Новость обновлена!');
        }

        $request->flash();
        return redirect()->route('admin.news.create');
    }

    /**
     * @param News $news
     * @return RedirectResponse
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
