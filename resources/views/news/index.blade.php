@extends('./../layouts.app')

@section('title')
    @parent | Новости категории "{{ $news->first()->category()->first()->title }}"
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="news">
                @forelse ($news as $article)
                    <div class="card card-body news__item mb-3">
                        <div>
                            <span class="badge badge-dark mb-3">{{ date('d.m.Y', strtotime($article->date)) }}</span>
                            <h5 class="card-title">{!! $article->title !!}</h5>
                        </div>
                        <a href="{{ route('news.show', [
                            'category' => $article->category()->first()->slug,
                            'id' => $article->id
                        ]) }}" class="card-link">Подробнее...</a>
                    </div>
                @empty
                    <p>Пока нет новостей. Но они появятся ;-)</p>
                @endforelse
            </div>
            {{ $news->links() }}
        </div>
    </div>
@endsection
