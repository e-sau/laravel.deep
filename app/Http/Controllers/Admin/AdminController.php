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
}
