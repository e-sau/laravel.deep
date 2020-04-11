@extends('./../layouts.app')

@section('title')
    @parent | Авторизация
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row mt-3">
        <div class="col">
            <p>Добро пожаловать в Админ-панель!</p>
            <p>Используйте меню для перехода в нужный раздел.</p>
        </div>
    </div>
@endsection
