@extends('./../layouts.app')

@section('content')
    <div class="content">
        <div class="news__item">
                <div class="article">
                    <div class="article__title">{{ $news['title'] }}</div>
                    <div class="article__content">{{ $news['content'] }}</div>
                    <div class="article__date">{{ $news['date'] }}</div>
                </div>
        </div>
    </div>
@endsection
