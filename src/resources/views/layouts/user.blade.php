<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <title>@yield('doc-title')</title>
</head>
<body>
<main
    style="display: flex; flex-wrap: nowrap; height: auto; min-height: 100vh; overflow-x: auto; overflow-y: hidden; background-color: rgba(0, 0, 0, .1);">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px; background: #4c6db5">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Привет,  {{auth()->user()->name}}</span>
            <button type="submit" value="logout" class="btn-exit btn-open-modal"><img
                    width="35px" src="{{ asset('img/exit.png') }}" alt=""></button>
        </a>
        <x-modal-window id="logout">
            <h1 style="color: black">Выйти из аккаунта?</h1>
            <div style="margin-top: 20px; ">
                <button style="width: 100px;" id="Logout" class="btn btn-primary">Да</button>
                <button style="width: 100px" class="btn btn-secondary btn-close-modal">Нет</button>
            </div>
        </x-modal-window>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route('admin-main-panel-page')}}"
                   class="{{ str_contains(request()->url(), '/home') || str_contains(request()->url(),'user') ? 'my-active-nav-link' : '' }} nav-link text-white"
                   aria-current="page">
                    Главная
                </a>
            </li>
            @canany(['actions on invoices', 'admin-panel'])
                <li class="nav-item">
                    <a href="{{route('invoices')}}"
                       class="{{ str_contains(request()->url(), 'invoice') ? 'my-active-nav-link' : '' }} nav-link text-white">
                        Накладные
                    </a>
                </li>
            @endcan
            @canany(['actions on products', 'admin-panel'])
                <li class="nav-item">
                    <a href="{{route('stocks')}}"
                       class="{{ str_contains(request()->url(), 'stock') ? 'my-active-nav-link' : '' }} nav-link text-white">
                        Продукция на складе
                    </a>
                </li>
            @endcan
            @canany(['actions on products', 'admin-panel'])
                <li class="nav-item">
                    <a href="{{route('products')}}"
                       class="{{ str_contains(request()->url(), 'products') ? 'my-active-nav-link' : '' }} nav-link text-white">
                        Продукты
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    <div style="width: 80%; margin: 20px auto; ">
        <div style=" height: 80px; padding: 15px; background: white; border-radius: 10px;">
            @yield('page-title')
        </div>
        <br>
        <div
            style=" height: 85%; padding: 15px; background: white; border-radius: 10px;">@yield('page-content')</div>
    </div>
    @yield('content')
</main>

<script>
    document.querySelectorAll('.btn-open-modal').forEach(w => {
        w.addEventListener('click', _ => {
            document.getElementById(w.value).style.display = "block";
        })
    })

    document.querySelectorAll('.btn-close-modal').forEach(w => {
        w.addEventListener('click', _ => {
            document.querySelectorAll('.mymodal').forEach(e => {
                e.style.display = "none";
            })
        })
    })
</script>
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
                location.href = "{{route('login')}}";
            },
            error: function (response) {
            },
        });
    });
</script>
</body>
</html>
