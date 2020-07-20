@extends('./../layouts.app')

@section('title')
    @parent | Категории
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <a class="btn btn-primary mb-5"
               href="{{ route('admin.category.create') }}">Добавить категорию</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group">
                @forelse ($categories as $category)
                    <div class="card card-body mb-2">
                        {{ $category->title }}
                        <div class="d-flex mt-4">
                            <a class="btn btn-outline-primary mr-1"
                               href="{{ route('admin.category.edit', $category) }}">Изменить</a>
                            <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="mr-1">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Удалить</button>
                            </form>
                            <form action="{{ route('admin.category.destroy_force', $category) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Удалить с новостями</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Нет категорий</p>
                @endforelse
            </div>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
