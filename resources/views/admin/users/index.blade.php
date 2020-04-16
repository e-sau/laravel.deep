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
                            @if(!$user->is_admin)
                                <a class="btn btn-outline-success mr-1"
                                   href="{{ route('profile.setAdmin', $user) }}"
                                   onclick="event.preventDefault(); document.getElementById('setAdmin-form').submit();">
                                    Сделать админом
                                </a>
                                <form id="setAdmin-form" action="{{ route('profile.setAdmin', $user) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endif
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
