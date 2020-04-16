@extends('./../layouts.app')

@section('title')
    @parent | Обновление данных профиля
@endsection

@section('menu')
    @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
        @include('admin.menu')
    @else
        @include('menu')
    @endif
@endsection

@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="form-group">
            <label for="name">Логин</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ false === old('name', false) ? ($user->name ?? '') : old('name') }}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('name') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ false === old('email', false) ? ($user->email ?? '') : old('email') }}">
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('password') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="newPassword">Новый пароль</label>
            <input type="password"
                   class="form-control @error('name') is-invalid @enderror"
                   id="newPassword"
                   name="newPassword">
            @if ($errors->has('newPassword'))
                <div class="invalid-feedback">
                    @foreach ($errors->get('newPassword') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
    </form>
@endsection
