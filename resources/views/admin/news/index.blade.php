@extends('./../layouts.app')

@section('title')
    @parent | Новости
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <a class="btn btn-primary mb-5"
               href="{{ route('admin.news.create') }}">Добавить новость</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="news">
                @forelse ($news as $article)
                    <div class="card card-body news__item mb-3">
                        <div>
                            <span class="badge badge-dark mb-3">{{ date('d.m.Y', strtotime($article->date)) }}</span>
                            <h5 class="card-title">{{ $article->title }}</h5>
                        </div>
                        <a href="{{ route('news.show', [
                            'category' => $article->category()->first()->slug,
                            'id' => $article->id
                        ]) }}" class="card-link">Подробнее...</a>
                        <div class="d-flex mt-4">
                            <a class="btn btn-outline-primary mr-1"
                               href="{{ route('admin.news.edit', $article) }}">Изменить</a>
                            <a class="btn btn-outline-danger"
                               href="{{ route('admin.news.destroy', $article) }}">Удалить</a>
                        </div>
                    </div>
                @empty
                    <p>Пока нет новостей. Но они появятся ;-)</p>
                @endforelse
            </div>
            {{ $news->links() }}
        </div>
    </div>
@endsection
