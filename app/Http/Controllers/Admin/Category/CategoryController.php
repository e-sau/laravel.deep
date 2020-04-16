<?php

namespace App\Http\Controllers\Admin\Category;

use App\Category;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        return view(
            'admin.category.index',
            [
                'categories' => Category::query()->paginate(6),
            ]
        );
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function edit(Category $category)
    {
        return view('admin.category.create', ['category' => $category]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        return $this->store($request, $category);
    }

    /**
     * @param Request $request
     * @param null $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, $category = null)
    {
        if (!($category instanceof Category)) {
            $category = new Category();
        }

        $data = $this->validate($request, Category::rules(), [], Category::attributeNames());

        $category->fill($data);
        $category->slug = \Str::slug($data['title']);

        if ($category->save()) {
            $successMessage = $request->isMethod('POST') ? 'Категория добавлена!' : 'Категория обновлена!';
            return redirect()->route('admin.category.index')->with('success', $successMessage);
        }

        $request->flash();
        return redirect()->route('admin.category.create');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        if ($category->news()->count()) {
            return redirect()->back()->with('error', 'Нельзя удалить категорию с новостями!');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Категория удалена!');
    }
}
