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
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .article {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 20px;
        box-sizing: border-box;
        width: 320px;
        min-height: 170px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-shadow: 2px 2px 3px #9f9f9f;
        cursor: pointer;
        transition: all .3s ease-in-out;
    }

    .article:hover {
        transform: translate(2px, -2px);
        box-shadow: 3px 3px 6px #9f9f9f;
    }

    .article__title {
        margin-bottom: 10px;
        font-size: 18px;
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
</style>
<body>
<div class="container m-t-lg">
    @yield('content')
</div>
<div class="flex-center links m-t-lg">
    <?php $routesLang = [
        'home' => 'Главная',
        'about' => 'О сайте',
        'news' => 'Новости'
    ]; ?>

    @foreach ($routesLang as $name => $title)
        @if (Route::currentRouteName() !== $name)
            <a href="{{ route($name) }}">{{ $routesLang[$name] }}</a>
        @endif
    @endforeach
</div>
</body>
</html>
