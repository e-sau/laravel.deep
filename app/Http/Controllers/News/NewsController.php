<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'news' => News::all()
        ]);
    }

    public function show($id)
    {
        return view('news.item', [
            'news' => News::one($id)
        ]);
    }

    public function showByFilter($filter)
    {
        if ($filter['category_id']) {
            return view('news.index', [
                'news' => News::getByCategoryId($filter['category_id'])
            ]);
        }
        return $this->index();
    }
}
