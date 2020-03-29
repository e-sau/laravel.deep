@extends('./../layouts.app')

@section('title')
    @parent | Категории
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="list-group">
                @forelse ($categories as $id => $category)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('news.category.show', ['category' => $category['slug']]) }}">
                        {{ $category['title'] }}
                    </a>
                @empty
                    <p class="fz-big">Нет категорий</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('news.create') }}">Добавить новость</a>
        </div>
    </div>
@endsection
