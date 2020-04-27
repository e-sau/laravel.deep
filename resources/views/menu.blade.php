@section('menu')
    <nav class="navbar navbar-expand navbar-dark bg-dark mb-5">
        <ul class="navbar-nav nav nav-pills">
            <li class="nav-item @if(Route::currentRouteName() === 'Home'){{ "active" }}@endif">
                <a class="nav-link"
                   href="{{ route('Home') }}">@lang('menu.home')</a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() == 'about'){{ "active" }}@endif">
                <a class="nav-link"
                   href="{{ route('about') }}">@lang('menu.about')</a>
            </li>
            <li class="nav-item @if(Route::currentRouteName() == 'news.category.index'
                    || Route::currentRouteName() == 'news.show'){{ "active" }}@endif">
                <a class="nav-link"
                   href="{{ route('news.category.index') }}">@lang('menu.news')</a>
            </li>
        </ul>
        <div class="left-menu d-flex ml-auto align-items-center">
            @guest
                <a class="btn btn-outline-light my-2 my-sm-0 mr-1"
                   href="{{ route('login') }}">{{ __('Логин') }}</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline-light my-2 my-sm-0"
                       href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                @endif
            @else
                @if(Auth::user()->avatar)
                    <div class="avatar mr-3">
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="width: 32px;">
                    </div>
                @endif
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
