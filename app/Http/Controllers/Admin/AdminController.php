<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        $currentUserId = Auth::user()->id;

        return view('admin.users.index', [
            'users' => User::query()->get()->where('id', '!=', $currentUserId),
        ]);
    }
}
