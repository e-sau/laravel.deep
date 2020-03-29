@extends('layouts.app')

@section('title')
    @parent | О сайте
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="row">
        <div class="col text-center">
            <p class="fz-big">Это учебный проект студента GeekUniversity, написанный с использованием фреймворка Laravel</p>
            <p class="fz-big">И я буду хорошим, успешным, продвинутым, востребованным программистом ;-)</p>
        </div>
    </div>
@endsection
