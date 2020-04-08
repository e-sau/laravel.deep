@section('menu')
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="dropdown">
            <button class="navbar-toggler" id="dropdownMenuButton" type="button" data-toggle="dropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item @if(Route::currentRouteName() === 'home'){{ "active" }}@endif"
                   href="{{ route('home') }}">@lang('menu.home')</a>
                <a class="dropdown-item" href="{{ route('auth.json') }}">@lang('menu.json')</a>
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
