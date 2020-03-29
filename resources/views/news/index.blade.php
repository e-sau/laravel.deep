@extends('./../layouts.app')

@section('content')
    <div class="content">
        <div class="news">
            @forelse ($news as $id => $article)
                <?php $slug = \App\Category::one($article['category_id'])['slug']; ?>
                <a href="{{ "/news/${slug}/${id}" }}" class="article__preview">
                    <div class="article__title">{{ $article['title'] }}</div>
                    <div class="article__content">{{ $article['content'] }}</div>
                    <div class="article__date">{{ $article['date'] }}</div>
                </a>
            @empty
                <p>Пока нет новостей. Но они появятся ;-)</p>
            @endforelse
        </div>
    </div>
@endsection
