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
            <a class="btn btn-primary" href="{{ route('admin.news.create') }}">Добавить новость</a>
        </div>
    </div>
@endsection
