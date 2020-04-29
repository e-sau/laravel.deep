@section('menu')
    <nav class="navbar navbar-expand navbar-dark bg-dark mb-5">
        <ul class="navbar-nav nav nav-pills">
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('Home') }}">@lang('menu.home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('about') }}">@lang('menu.about')</a>
            </li>
        </ul>
        <div class="left-menu d-flex ml-auto align-items-center">
            @if(Auth::user()->avatar)
                <div class="avatar mr-3">
                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="width: 32px;">
                </div>
            @endif
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.create'])){{ "active" }}@endif"
                       href="{{ route('admin.category.index') }}">@lang('menu.categories')</a>
                    <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.news.index', 'admin.news.create'])){{ "active" }}@endif"
                       href="{{ route('admin.news.index') }}">@lang('menu.news')</a>
                    @if(Auth::user()->is_admin)
                        <a class="dropdown-item" href="{{ route('admin.users') }}">@lang('Пользователи')</a>
                        <a class="dropdown-item" href="{{ route('admin.resources.index') }}">@lang('RSS ресурсы')</a>
                        <a class="dropdown-item" href="{{ route('admin.parse') }}">@lang('Спарсить новости')</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('admin.news.json') }}">@lang('menu.json')</a>
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
        </div>
    </nav>
@endsection
