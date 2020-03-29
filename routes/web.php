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

Route::get('/news', 'Category\CategoryController@index')->name('category.index');

Route::group([
    'namespace' => 'News',
    'as' => 'news.'
], function () {
    // Наверное так делать не стоило, а хотелось, чтобы было именно так
    // Возникла проблема с роутом для создания новости.
    // Разобраться не успел.
    Route::get('/news/{category_slug}', function ($categorySlug) {
        $categoryId = \App\Category::getIdBySlug($categorySlug);
        $news = \App\News::getByCategoryId($categoryId);
        return view('news.index', ['news' => $news]);
    })->name('category');
    Route::get('/news/{category_slug}/{id?}', function ($categorySlug, $id) {
        return view('news.item', ['news' => \App\News::one((int) $id)]);
    })->name('show');
});


Route::get('/about', function () {
    return view('about');
})->name('about');
