@extends('layouts.app')

@section('doc-title')
    Админ панель
@endsection

@section('content')
    @auth('admin')
        <h1>Привет Админ</h1>
        <button type="submit" id="Logout">Выйти</button>
    @endauth

    <script type="text/javascript">
        $('#Logout').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('admin-logout')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    location.href = "{{route('login')}}";
                },
                error: function (response) {
                },
            });
        });
    </script>
@endsection
