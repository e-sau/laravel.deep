@extends('./../layouts.app')

@section('title')
    @parent | Добавить ресурс
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST"
          action="{{ empty($resource) ? route('admin.resources.index') : route('admin.resources.update', $resource)}}">
        @if(!empty($resource))
            @method('PUT')
        @endif
        @csrf
        <div class="form-group">
            <label for="url">Ссылка</label>
            <input type="text"
                   class="form-control @error('url') is-invalid @enderror"
                   id="url"
                   name="url"
                   value="{{ $resource->url ?? old('url') }}">
            @error('url')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            @if(!empty($resource->id))
                Изменить
            @else
                Добавить
            @endif
        </button>
    </form>
@endsection
