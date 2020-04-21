<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('Home');
});

Route::get('/home', function () {
    return view('home');
})->name('Home');

Route::group([
    'namespace' => 'News',
    'as' => 'news.'
], function () {
    Route::get('/news/category/{category}/{news}', 'NewsController@show')->name('show');

    Route::group([
       'as' => 'category.'
    ], function () {
        Route::get('/news/categories', 'CategoryController@index')->name('index');
        Route::get('/news/category/{category}', 'CategoryController@show')->name('show');
    });
});

Route::group([
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'is_admin']
], function () {
    Route::get('/admin', 'AdminController@index')->name('index');
    Route::get('/admin/users', 'AdminController@users')->name('users');

    Route::group([
        'namespace' => 'News',
        'as' => 'news.',
        'prefix' => 'admin'
    ], function () {
        Route::get('/news/', 'NewsController@index')->name('index');
        Route::get('/news/create', 'NewsController@create')->name('create');
        Route::post('/news/create', 'NewsController@create')->name('create')->middleware('check_news_form');
        Route::get('/news/edit/{news}', 'NewsController@edit')->name('edit');
        Route::post('/news/update/{news}', 'NewsController@update')->name('update')->middleware('check_news_form');
        Route::get('/news/destroy/{news}', 'NewsController@destroy')->name('destroy');
        Route::get('/news/json', 'NewsController@json')->name('json');
    });

    Route::resource('admin/category', 'Category\CategoryController');
});

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile',
    'middleware' => 'auth'
], function () {
    Route::match(['get', 'post'], '/update/', 'ProfileController@update')->name('update');
});

Route::post('/profile/toggleAdmin/', 'ProfileController@toggleAdmin')
    ->middleware(['auth', 'is_admin'])->name('profile.toggleAdmin');

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::get('login/github', 'SocLoginController@requestGitHub')->name('requestGitHub');
Route::get('login/github/callback', 'SocLoginController@responseGitHub')->name('responseGitHub');
