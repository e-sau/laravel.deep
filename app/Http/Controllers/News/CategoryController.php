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
        return view('news.category.index', ['categories' => Category::all()]);
    }

    public function show($slug)
    {
        $id = Category::getIdBySlug($slug);

        if ($id === null) {
            return redirect()->route('news.index');
        }

        return view(
            'news.index',
            [
                'news' => News::getByCategoryId($id),
                'slug' => $slug
            ]
        );
    }
}
