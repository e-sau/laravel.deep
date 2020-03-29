<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel.Deep</title>
</head>
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .container {
        padding: 0 15px;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-t-lg {
        margin-top: 60px;
    }

    .m-t-md {
        margin-top: 30px;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    .news {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 15px;
    }

    .news__item {
        display: flex;
        justify-content: center;
    }

    .article {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        max-width: 500px;
    }

    .article__preview {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 20px;
        box-sizing: border-box;
        min-height: 170px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        text-decoration: none;
        cursor: pointer;
        transition: all .3s ease-in-out;
    }

    .article__preview:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 10px rgba(121, 85, 72, .35);
    }

    .article__title {
        margin-bottom: 10px;
        font-size: 18px;
        color: #000;
    }

    .article__content {
        font-size: 14px;
        color: #353a40;
    }

    .article__date {
        text-align: right;
        font-size: 10px;
        color: #9a6f1d;
    }

    .category {
        padding: 0;
        list-style-type: none;
    }

    .category__item {

    }

    .category__link {
        position: relative;
        box-sizing: border-box;
        width: 220px;
        height: 40px;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: 600;
        color: #1b4b72;
        text-decoration: none;
        background: #fff;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        border-left: 1px solid #ccc;
        transition: background-color .3s;
    }

    .category__link:hover, .category__link:hover:after {
        background: #e4eafa;
    }

    .category__link:after {
        content: "";
        position: absolute;
        box-sizing: border-box;
        right: -14px;
        top: 5px;
        width: 28px;
        height: 28px;
        background: #fff;
        border-top: 1px solid #ccc;
        border-right: 1px solid #ccc;
        transform: rotate(45deg);
        transition: background-color .3s;
    }

    .btn {
        box-sizing: border-box;
        width: 200px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #fff;
        background: #6892ff;
        border: 1px solid #6892ff;
        border-radius: 20px;
        transition: all .4s;
    }

    .btn:hover {
        color: #6892ff;
        background: #fff;
    }
</style>
<body>
<div class="flex-center links m-t-lg">
    @section('menu')
        <a href="<?=route('home')?>">@lang('menu.home')</a>
        <a href="<?=route('about')?>">@lang('menu.about')</a>
        <a href="<?=route('category.index')?>">@lang('menu.news')</a>
    @show
</div>
<div class="container m-t-lg">
    @yield('content')
</div>
</body>
</html>
