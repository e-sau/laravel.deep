@extends('./../layouts.app')

@section('title')
    @parent | Авторизация
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <div class="alert alert-secondary d-inline-block mt-5" role="alert">
        Логин: "user", пароль: "12345"
    </div>
@endsection
