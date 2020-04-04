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
    Route::get('/news/create', 'NewsController@create')->name('create');
    Route::post('/news', 'NewsController@store')->name('store');

    Route::group([
       'as' => 'category.'
    ], function () {
        Route::get('/news/categories', 'CategoryController@index')->name('index');
        Route::get('/news/category/{category}', 'CategoryController@show')->name('show');
    });
});

Route::get('/auth', 'User\UserController@index')->name('auth.index');
Route::post('/auth/login', 'User\UserController@login')->name('auth.login');
Route::get('/auth/logout', 'User\UserController@logout')->name('auth.logout');

Route::get('/about', function () {
    return view('about');
})->name('about');
