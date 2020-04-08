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
@endsection
