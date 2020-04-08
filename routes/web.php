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

Route::get('/news', 'News\CategoryController@index')->name('news.category.index');

Route::group([
    'namespace' => 'News',
    'as' => 'news.'
], function () {
    Route::get('/news', 'NewsController@index')->name('index');
    Route::get('/news/category/{category}/{id}', 'NewsController@show')->name('show');
    Route::match(['get', 'post'], '/news/create', 'NewsController@create')->name('create');

    Route::group([
       'as' => 'category.'
    ], function () {
        Route::get('/news/categories', 'CategoryController@index')->name('index');
        Route::get('/news/category/{category}', 'CategoryController@show')->name('show');
    });
});

Route::group([
    'namespace' => 'User',
    'as' => 'auth.'
], function () {
    Route::get('/auth', 'UserController@index')->name('index');
    Route::post('/auth/login', 'UserController@login')->name('login');
    Route::get('/auth/logout', 'UserController@logout')->name('logout');
    Route::get('/auth/json', 'UserController@json')->name('json');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
