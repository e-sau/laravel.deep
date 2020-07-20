<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Resources;
use App\Jobs\NewsParsing;

class ParseController extends Controller
{
    public function index()
    {
        foreach (Resources::all() as $resources) {
            NewsParsing::dispatch($resources->url);
        }

        return redirect()->route('admin.news.index');
    }
}
