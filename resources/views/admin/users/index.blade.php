@extends('./../layouts.app')

@section('title')
    @parent | Пользователи
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            @if(!empty($users))
                <ul class="list-group">
                    @forelse($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $user->name }}
                            <div class="d-flex">
                                <toggle-admin-button-component :user='@json($user)'></toggle-admin-button-component>
                            </div>
                        </li>
                    @empty
                        <p>На сайте вы единственный пользователь! ¯\_(ツ)_/¯</p>
                    @endforelse
                </ul>
            @endif
        </div>
    </div>
@endsection
