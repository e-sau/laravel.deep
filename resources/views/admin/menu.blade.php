@section('menu')
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Меню
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item @if(Route::currentRouteName() === 'home'){{ "active" }}@endif"
                   href="{{ route('Home') }}">@lang('menu.home')</a>
                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.create'])){{ "active" }}@endif"
                   href="{{ route('admin.category.index') }}">@lang('menu.categories')</a>
                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.news.index', 'admin.news.create'])){{ "active" }}@endif"
                   href="{{ route('admin.news.index') }}">@lang('menu.news')</a>
                @if(Auth::user()->is_admin)
                    <a class="dropdown-item" href="{{ route('admin.users') }}">@lang('Пользователи')</a>
                @endif
                <a class="dropdown-item" href="{{ route('admin.news.json') }}">@lang('menu.json')</a>
            </div>
        </div>
        <div class="left-menu">
            @guest
                <a class="btn btn-outline-info my-2 my-sm-0"
                   href="{{ route('login') }}">{{ __('Логин') }}</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline-info my-2 my-sm-0"
                       href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                @endif
            @else
                <div class="dropdown">
                    <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('profile.update') }}">@lang('Профиль')</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
@endsection
