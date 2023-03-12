@extends('layouts.user')

@section('doc-title')
    Главная
@endsection

@section('page-title')
    <h2>Провайдеры</h2>
@endsection

@section('page-content')
    <div style="display:flex; justify-content: space-between; margin: 20px 0;">
        <button class="btn btn-dark btn-open-modal" value="{{'create-provider'}}"><a>Добавить</a></button>
    </div>

    <x-modal-window id="{{'create-provider'}}">
        <form style="margin: 20px;" id="CreateProvider">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="createProviderErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div class="form-group">
                    <label for="name">Поставщик</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                    Закрыть
                </button>
                <button type="submit" style="margin: 10px" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </x-modal-window>

    <hr/>
    {{--    ВЫВОД ВСЕХ     --}}
    <table class="table table-striped" style="margin: 0 auto;">
        <thead>
        <tr>
            <th scope="col">поставщик</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($providers as $el)
            <tr>
                <td>{{$el->name}}</td>
                <td>
                    <button class="btn btn-warning show-product"><a
                            href="{{route('providers.show', $el->id)}}">Просмотр</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$providers->links()}}
    </div>

    <script type="text/javascript">
        $('#CreateProvider').on('submit', function (e) {
            e.preventDefault();
            let name = $('#name').val();
            $.ajax({
                url: "{{route('providers.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                },
                success: function () {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#createProviderErrors');
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
@endsection
