@extends('layouts.app')

@section('menu')
    <a href="<?=route('home')?>">@lang('menu.home')</a>
    <a href="<?=route('about')?>">@lang('menu.about')</a>
    <a href="<?=route('news')?>">@lang('menu.news')</a>
@endsection
