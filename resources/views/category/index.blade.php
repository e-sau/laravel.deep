@extends('./../layouts.app')

@section('content')
    <ul class="category">
        @forelse ($categories as $id => $category)
            <li class="category__item">
                <a class="category__link" href="{{ route('news.category', ['category_slug' => $category['slug']]) }}">
                    {{ $category['title'] }}
                </a>
            </li>
        @empty
            <p>Нет категорий</p>
        @endforelse
    </ul>
    <a class="btn" href="{{ route('news.create') }}">Добавить новость</a>
@endsection
