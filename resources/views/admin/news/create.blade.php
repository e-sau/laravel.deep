@extends('./../layouts.app')

@section('title')
    @parent | Добавить новость
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.news.create') }}">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea class="form-control"
                      id="content"
                      rows="3"
                      name="content">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" id="category_id" name="category_id">
                @forelse ($categories as $id => $category)
                    <option value="{{ $id }}"
                    @if (old('category_id') == $id) selected @endif>{{ $category['title'] }}
                    </option>
                @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date"
                   class="form-control"
                   id="date"
                   name="date"
                   value="{{ old('date') }}">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
@endsection