@extends('./../layouts.app')

@section('title')
    @parent | Добавить новость
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST"
          action="{{ !empty($news) ? route('admin.news.update', $news) : route('admin.news.create')}}">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text"
                   class="form-control"
                   id="title"
                   name="title"
                   value="{{ $news->title ?? old('title') }}">
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <textarea class="form-control"
                      id="content"
                      rows="3"
                      name="content">{{ $news->content ?? old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" id="category_id" name="category_id">
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if ((!empty($news) && $news->category_id == $category->id)
                                || old('category_id') == $category->id)
                            selected
                        @endif>
                        {{ $category->title }}
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
                   value="{{ $news->date ?? old('date') }}">
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="form-control-file" name="image">
                @if (!empty($news->image))
                    <a class="btn btn-link" href="{{ $news->image }}">Изображение</a>
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            @if(!empty($news->id))
                Изменить
            @else
                Добавить
            @endif
        </button>
    </form>
@endsection
