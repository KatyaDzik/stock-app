@extends('layouts.app')

@section('doc-title')
    Авторизация
@endsection

@section('content')

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                         class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="LoginForm">
                        @csrf
                        <h1 style="text-align: center" class="lead fw-normal mb-0 me-3">Вход в систему</h1>
                        <hr>

                        <!-- Login input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="login" class="form-control form-control-lg"
                                   placeholder="Введите логин"/>
                            <div id="validationLogin" class="invalid-feedback">

                            </div>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="password" class="form-control form-control-lg"
                                   placeholder="Введите пароль"/>
                            <div id="validationPassword" class="invalid-feedback">

                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="adminCheck"/>
                                <label class="form-check-label" for="form2Example3">
                                    Войти как администратор
                                </label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Войти
                            </button>

                            {{--                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"--}}
                            {{--                                                                                          class="link-danger">Register</a></p>--}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $('#LoginForm').on('submit', function (e) {
            e.preventDefault();
            let login = $('#login').val();
            let password = $('#password').val();
            let isAdmin = $('#adminCheck').is(":checked");

            if (isAdmin === false) {
                $.ajax({
                    url: "{{route('login')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        login: login,
                        password: password
                    },
                    success: function (response) {
                        location.href = "{{route('home')}}";
                    },
                    error: function (response) {
                        outputErrors(response);
                    },
                });
            }

            if (isAdmin === true) {
                $.ajax({
                    url: "{{route('admin-login')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        login: login,
                        password: password
                    },
                    success: function (response) {
                        location.href = "{{route('admin-main-panel-page')}}";
                    },
                    error: function (response) {
                        outputErrors(response);
                    },
                });

            }
        });
    </script>

    <script type="text/javascript">
        function outputErrors(obj) {
            console.log(obj);
            let login_errors_div = $('#validationLogin');
            login_errors_div.empty();
            let password_errors_div = $('#validationPassword');
            password_errors_div.empty();

            if (typeof obj.responseJSON.error !== 'undefined') {
                let p = document.createElement('p');
                p.innerHTML = obj.responseJSON.error;
                password_errors_div.append(p);
                password_errors_div[0].style.display = "block";
            }

            if (typeof obj.responseJSON.errors.login !== 'undefined') {
                let p = document.createElement('p');
                p.innerHTML = obj.responseJSON.errors.login[0];
                login_errors_div.append(p);
                login_errors_div[0].style.display = "block";
            }

            if (typeof obj.responseJSON.errors.password !== 'undefined') {
                let p = document.createElement('p');
                p.innerHTML = obj.responseJSON.errors.password[0];
                password_errors_div.append(p);
                password_errors_div[0].style.display = "block";
            }
        }
    </script>

@endsection
