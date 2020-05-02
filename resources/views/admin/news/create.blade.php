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
                   class="form-control @error('title') is-invalid @enderror"
                   id="title"
                   name="title"
                   value="{{ false === old('title', false) ? ($news->title ?? '') : old('title') }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Текст</label>
            <ckeditor-component class="@error('content') is-invalid @enderror"
                                value="{!! false === old('content', false) ? htmlspecialchars($news->content ?? '') : htmlspecialchars(old('content')) !!}"
            ></ckeditor-component>
            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control @error('category_id') is-invalid @enderror"
                    id="category_id"
                    name="category_id">
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}"
                            @if ((old('category_id') == $category->id ||
                                    !empty($news) && $news->category_id == $category->id))
                            selected
                        @endif>
                        {{ $category->title }}
                    </option>
                @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
            @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="date">Дата</label>
            <input type="date"
                   class="form-control @error('date') is-invalid @enderror"
                   id="date"
                   name="date"
                   value="{{ false === old('date', false) ? ($news->date ?? '') : old('date') }}">
            @error('date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file"
                       class="form-control-file @error('image') is-invalid @enderror"
                       name="image">
                @if (!empty($news->image))
                    <a class="btn btn-link" href="{{ $news->image }}">Изображение</a>
                @endif
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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
