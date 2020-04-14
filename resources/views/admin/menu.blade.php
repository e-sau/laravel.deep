@section('menu')
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Меню
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item @if(Route::currentRouteName() === 'home'){{ "active" }}@endif"
                   href="{{ route('home') }}">@lang('menu.home')</a>
                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.category.index', 'admin.category.create'])){{ "active" }}@endif"
                   href="{{ route('admin.category.index') }}">@lang('menu.categories')</a>
                <a class="dropdown-item @if(in_array(Route::currentRouteName(), ['admin.news.index', 'admin.news.create'])){{ "active" }}@endif"
                   href="{{ route('admin.news.index') }}">@lang('menu.news')</a>
                <a class="dropdown-item" href="{{ route('admin.news.json') }}">@lang('menu.json')</a>
            </div>
        </div>
        <div class="left-menu">
            <a class="btn btn-outline-info my-2 my-sm-0"
               href=
               @if(!session('auth'))
                   "{{ route('auth.index') }}">@lang('menu.login')
                @else
                    "{{ route('auth.logout') }}">@lang('menu.logout')
                @endif
            </a>
        </div>
    </nav>
@endsection
