@extends('layouts.app')

@section('title')
    @parent | Главная
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="row">
        <div class="col text-center">
            <h3 class="title">Привет, исследователь!</h3>
            <h4>Я приветствую тебя на моем сайте, надеюсь тебе здесь понравится :-)</h4>
        </div>
    </div>
@endsection
