@extends('./../layouts.app')

@section('title')
    @parent | RSS ресурсы
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <a class="btn btn-primary mb-5"
               href="{{ route('admin.resources.create') }}">Добавить ссылку</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group">
                @forelse ($resources as $resource)
                    <div class="card card-body mb-2">
                        {{ $resource->url }}
                        <div class="d-flex mt-4">
                            <a class="btn btn-outline-primary mr-1"
                               href="{{ route('admin.resources.edit', $resource) }}">Изменить</a>
                            <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Удалить</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Список ресурсов пуст</p>
                @endforelse
            </div>
            {{ $resources->links() }}
        </div>
    </div>
@endsection
