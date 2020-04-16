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
    return view('greetings');
})->name('home');

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

//Route::middleware(\App\Http\Middleware\CheckAuth::class)->namespace('Admin')->as('admin.')
//    ->group(function () {
Route::group([
    'namespace' => 'Admin',
    'as' => 'admin.'
], function () {
    Route::get('/admin', 'AdminController@index')->name('index');

    Route::group([
        'namespace' => 'News',
        'as' => 'news.'
    ], function () {
        Route::get('/admin/news/', 'NewsController@index')->name('index');
        Route::match(['get', 'post'], '/admin/news/create', 'NewsController@create')->name('create');
        Route::get('/admin/news/edit/{news}', 'NewsController@edit')->name('edit');
        Route::post('/admin/news/update/{news}', 'NewsController@update')->name('update');
        Route::get('/admin/news/destroy/{news}', 'NewsController@destroy')->name('destroy');
        Route::get('/admin/news/json', 'NewsController@json')->name('json');
    });

    Route::resource('admin/category', 'Category\CategoryController');
});

Route::group([
    'namespace' => 'User',
    'as' => 'auth.'
], function () {
    Route::get('/auth', 'UserController@index')->name('index');
    Route::post('/auth/login', 'UserController@login')->name('login');
    Route::get('/auth/logout', 'UserController@logout')->name('logout');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
