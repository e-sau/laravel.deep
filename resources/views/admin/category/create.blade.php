@extends('./../layouts.app')

@section('title')
    @parent | Добавить новость
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST"
          action="{{ empty($category) ? route('admin.category.index') : route('admin.category.update', $category)}}">
        @if(!empty($category))
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="title">Название категории</label>
            <input type="text"
                   class="form-control @error('title') is-invalid @enderror"
                   id="title"
                   name="title"
                   value="{{ $category->title ?? old('title') }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            @if(!empty($category->id))
                Изменить
            @else
                Добавить
            @endif
        </button>
    </form>
@endsection
