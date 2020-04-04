@if(!session('auth'))
    @php
        header("Location: " . URL::to('/'), true, 302);
        exit();
    @endphp
@endif

@extends('./../layouts.app')

@section('title')
    @parent | Добавить новость
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <form method="POST" action="{{ route('news.index') }}">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea class="form-control" id="content" rows="3" name="content"></textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" id="category_id" name="category_id">
                @forelse ($categories as $id => $category)
                    <option value="{{ $id }}">{{ $category['title'] }}</option>
                @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="date">Заголовок</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
