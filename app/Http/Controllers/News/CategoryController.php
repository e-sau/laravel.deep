<?php

namespace App\Http\Controllers\News;

use App\Category;
use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view(
            'news.category.index',
            [
                'categories' => Category::query()->paginate(6),
            ]
        );
    }

    public function show(Category $category)
    {
        return view(
            'news.index',
            [
                'news' => News::query()
                    ->where('category_id', $category->id)
                    ->paginate(6),
            ]
        );
    }
}
