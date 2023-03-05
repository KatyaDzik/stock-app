@extends('layouts.user')

@section('doc-title')
    Продукция на складе
@endsection

@section('page-title')
    <h2>Продукция на складе</h2>
@endsection

@section('page-content')
    <div style="display:flex; justify-content: space-between; margin: 20px 0;">
        <button class="btn btn-dark btn-open-modal" value="{{'create-stock'}}"><a>Добавить</a></button>
    </div>

    <x-modal-window id="{{'create-stock'}}">
        <form style="margin: 20px;" id="CreateStock">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="createStockErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div>

                    <div class="form-group">
                        <label for="name">Наименование</label><span class="required-field"> *</span>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="address">Адрес</label><span class="required-field"> *</span>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

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
    {{--    ВЫВОД ВСЕХ НАКЛАДНЫХ    --}}
    <table class="table table-striped" style="margin: 0 auto;">
        <thead>
        <tr>
            <th scope="col">наименование</th>
            <th scope="col">адрес</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $el)
            <tr>
                <td>{{$el->name}}</td>
                <td>{{$el->address}}</td>
                <td>
                    <button class="btn btn-warning show-product"><a
                            href="{{route('get.product.from.stock', $el->id)}}">Просмотр</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$stocks->links()}}
    </div>

    <script type="text/javascript">
        $('#CreateStock').on('submit', function (e) {
            e.preventDefault();
            let name = $('#name').val();
            let address = $('#address').val();
            $.ajax({
                url: "{{route('stocks.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    address: address,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#createStockErrors');
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
