@section('menu')
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Меню
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item @if(Route::currentRouteName() === 'home'){{ "active" }}@endif"
                   href="{{ route('Home') }}">@lang('menu.home')</a>
                <a class="dropdown-item  @if(Route::currentRouteName() == 'about'){{ "active" }}@endif"
                   href="{{ route('about') }}">@lang('menu.about')</a>
                <a class="dropdown-item
                    @if(Route::currentRouteName() == 'news.category.index'
                    || Route::currentRouteName() == 'news.show'){{ "active" }}@endif"
                   href="{{ route('news.category.index') }}">@lang('menu.news')</a>
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
                        @if(Auth::user()->is_admin)
                            <a class="dropdown-item" href="{{ route('admin.index') }}">@lang('menu.admin')</a>
                        @endif
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
