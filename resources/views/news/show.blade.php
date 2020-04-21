@extends('./../layouts.app')

@section('title')
    @parent | {{ $news->title }}
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <span class="badge badge-secondary">{{ date('d.m.Y', strtotime($news->date)) }}</span>
                <h5 class="card-header">{{ $news->title }}</h5>
                <div class="card-body">
                    <p class="card-text">{{ $news->content }}</p>
                </div>
                @if(!empty($news->image))
                <img src="{{ $news->image }}" class="card-img-top img-fluid mt-3" alt="image">
                @endif
            </div>
        </div>
    </div>
@endsection
