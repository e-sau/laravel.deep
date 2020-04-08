<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function json()
    {
        return response()
            ->json(News::all())
            ->header('Content-Disposition', 'attachment; filename = "news.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
