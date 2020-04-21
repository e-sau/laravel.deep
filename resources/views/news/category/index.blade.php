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
            <div class="list-group mb-3">
                @forelse ($categories as $category)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('news.category.show', $category) }}">
                        {{ $category->title }}
                    </a>
                @empty
                    <p class="fz-big">Нет категорий</p>
                @endforelse
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
