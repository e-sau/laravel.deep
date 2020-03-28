@extends('./../layouts.app')

@section('content')
    <form method="POST" action="/news/create">
        <label for="title">Заголовок</label>
        <input id="title" type="text" class="">
        <label for="content">Текст</label>
        <input id="content" type="text" class="">
        <label for="category_id">Категория</label>
        <input id="category_id" type="text" class="">
        <label for="date">Дата</label>
        <input id="date" type="date" class="">
        <input type="submit" value="Создать">
    </form>
@endsection
