@extends('layouts.admin')

@section('doc-title')
    Админ панель
@endsection

@section('page-title')
    Пользователи
@endsection

@section('page-content')
    <div class="container">
        <div style="display:flex; justify-content: space-between; margin: 20px 0;">
            <button value="create" class="btn btn-dark btn-open-modal"><a>Добавить</a></button>
        </div>

        <hr/>
        {{--    ВЫВОД ВСЕХ ПОЛЬЗОВАТЕЛЕЙ    --}}
        <table class="table table-striped" style="margin: 0 auto;">
            <thead>
            <tr>
                <th scope="col">Имя</th>
                <th scope="col">Логин</th>
                <th scope="col">Роль</th>
            </tr>
            </thead>
            <tbody>
            @if(count($users)>0)
                @foreach($users as $el)
                    <tr>
                        <td>{{$el->name}}</td>
                        <td>{{$el->login}}</td>
                        <td>{{$el->role->name}}</td>
                        <td><a href="{{route('admin-read-user', $el->id)}}">
                                <button class="btn btn-warning">Просмотр</button>
                            </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        {{--МОДАЛЬНОЕ ОКНО ДОБАВЛЕНИЯ ПОЛЬЗОВАТЕЛЯ--}}
        <x-modal-window id="create">
            <form style="margin: 20px;" id="CreateUser">
                {{--     Блок для вывода ошибок       --}}
                <div style="display: none" id="createUserErrors" class="alert alert-danger"></div>
                {{--         Форма       --}}
                @csrf
                <div class="form-group">
                    <label for="name">Имя</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="login">Логин</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="login" name="login">
                </div>

                <div class="form-group">
                    <label for="role">Роль</label><span class="required-field"> *</span>
                    @php( $roles = \App\Repositories\RoleRepository::getAll())
                    <select class="form-select roles" id="roles" aria-label="Default select example">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label><span class="required-field"> *</span>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmed">Повторите пароль</label><span class="required-field"> *</span>
                    <input type="password" class="form-control" id="password_confirmed" name="password_confirmed">
                </div>

                <div class="modal-footer">
                    <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                        Закрыть
                    </button>
                    <button type="submit" style="margin: 10px" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </x-modal-window>

        <script type="text/javascript">
            $('#CreateUser').on('submit', function (e) {
                e.preventDefault();
                let name = $('#name').val();
                let login = $('#login').val();
                let role_id = $("#roles option:selected").val();
                let password = $('#password').val();
                let password_confirmed = $('#password_confirmed').val();
                console.log(role_id);
                $.ajax({
                    url: "{{route('admin-create-user')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        login: login,
                        role_id: role_id,
                        password: password,
                        password_confirmed: password_confirmed
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function (response) {
                        let obj = JSON.parse(response.responseText);
                        if (typeof obj.errors !== 'undefined') {
                            let errors_div = $('#createUserErrors');
                            errors_div.empty();
                            for (key in obj.errors) {
                                obj.errors[key].forEach(function (elem) {
                                    let p = document.createElement('p');
                                    p.innerHTML = elem;
                                    errors_div.append(p)
                                    console.log(elem);
                                });
                            }
                            errors_div[0].style.display = "block";
                        }
                    },
                });
            });
        </script>
    </div>
@endsection
