@extends('layouts.app')

@section('doc-title')
    Главная
@endsection

@section('content')
    <h1>HOME PAGE</h1>
    @auth('web')
        <h1>Привет {{auth('web')->user()->name}}</h1>
        <button type="submit" id="Logout">Выйти</button>
    @endauth

    @guest('web')
        <button><a href="{{route('login-page')}}">Войти</a></button>
    @endguest

    <script type="text/javascript">
        $('#Logout').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('logout')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    location.href = "{{route('home')}}";
                },
                error: function (response) {
                },
            });
        });
    </script>
@endsection
