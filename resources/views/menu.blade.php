@section('menu')
    <nav class="navbar-expand navbar navbar-dark bg-dark justify-content-end mb-5">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName() === 'home'){{ "active" }}@endif"
                   href="<?=route('home')?>">@lang('menu.home')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(Route::currentRouteName() == 'about'){{ "active" }}@endif"
                   href="<?=route('about')?>">@lang('menu.about')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                    @if(Route::currentRouteName() == 'news.category.index'
                    || Route::currentRouteName() == 'news.show'){{ "active" }}@endif"
                   href="<?=route('news.category.index')?>">@lang('menu.news')</a>
            </li>
        </ul>
    </nav>
@endsection
