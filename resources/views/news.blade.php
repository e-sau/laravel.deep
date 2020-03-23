@extends('layouts.app')

@section('content')
    <?php $news = [
        [
            'title' => 'Объявлен мир во всем мире',
            'content' => 'Сегодня, 23 марта 2020 года был провозглашен мир во всем мире. Ура, товарищи!',
            'date' => '23.03.2020'
        ],
        [
            'title' => 'Российские ученые победили рак',
            'content' => 'Сегодня, 22 марта 2020 года российскими учеными был изобретен препарат, который уничтожает раковые клетки во всех их проявлениях и на любых стадиях. Ура, товарищи!',
            'date' => '22.03.2020'
        ],
        [
            'title' => 'Колонизация Марса',
            'content' => 'Сегодня, 21 марта 2020 года российским космическим экипажем на корабле "Марс-1" была проведена успешная посадка на Марс. С этого дня началась эпоха колонизации Марса. Ура, товарищи!',
            'date' => '21.03.2020'
        ],
    ] ?>
    <div class="content">
        <div class="news">
            @foreach ($news as $article)
                <div class="article">
                    <div class="article__title">{{ $article['title'] }}</div>
                    <div class="article__content">{{ $article['content'] }}</div>
                    <div class="article__date">{{ $article['date'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
