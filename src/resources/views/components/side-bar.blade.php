<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Привет,  {{auth('admin')->user()->name}}</span>
        <button type="submit" value="logout" class="btn-exit btn-open-modal"><img
                width="35px" src="{{ asset('img/exit.png') }}" alt=""></button>
    </a>
    <x-modal-window id="logout">
        <h1 style="color: black">Выйти из аккаунта?</h1>
        <div style="margin-top: 20px; ">
        <button style="width: 100px;" id="Logout" class="btn btn-primary">Да</button>
        <button style="width: 100px" class="btn btn-secondary btn-close-modal">Нет</button></div>
    </x-modal-window>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('admin-main-panel-page')}}"
               class="{{ str_contains(request()->url(), '/admin/home') ? 'active' : '' }} nav-link text-white"
               aria-current="page">
                Пользователи
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin-settings')}}"
               class="{{ str_contains(request()->url(), '/admin/settings') ? 'active' : '' }} nav-link text-white">
                Настройки
            </a>
        </li>
    </ul>

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
</div>

