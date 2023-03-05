@extends('layouts.user')

@section('doc-title')
    Накладные
@endsection

@section('page-title')
    <h2>Накладные</h2>
@endsection

@section('page-content')
    <div style="display:flex; justify-content: space-between; margin: 20px 0;">
        <button class="btn btn-dark btn-open-modal" value="{{'create-invoice'}}"><a>Добавить</a></button>
    </div>

    <x-modal-window id="{{'create-invoice'}}">
        <form style="margin: 20px;" id="AddInvoice">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="createInvoiceErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div style="display: flex; justify-content: space-between">
                    <div>
                        <div class="form-group">
                            <label for="number">Номер</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="number" name="number">
                        </div>

                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>

                        <div class="form-group">
                            <label for="from">Адрес грузоотправителя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="from" name="from">
                        </div>

                        <div class="form-group">
                            <label for="to">Адрес грузополучателя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="to" name="to">
                        </div>

                    </div>

                    <div>
                        <div class="form-group">
                            <label for="providers">Поставщик</label><span class="required-field"> *</span>
                            @php( $providers = \App\Repositories\ProviderRepository::getAll())
                            <select class="form-select providers" id="providers" aria-label="Default select example">
                                @foreach($providers as $provider)
                                    <option
                                        value="{{$provider->id}}">{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customers">Заказчик</label><span class="required-field"> *</span>
                            @php( $customers = \App\Repositories\CustomerRepository::getAll())
                            <select class="form-select customers" id="customers" aria-label="Default select example">
                                @foreach($customers as $customer)
                                    <option
                                        value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="statuses">Статус</label><span class="required-field"> *</span>
                            @php( $statuses = \App\Repositories\StatusRepository::getAll())
                            <select class="form-select statuses" id="statuses" aria-label="Default select example">
                                @foreach($statuses as $status)
                                    <option
                                        value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="types">Тип</label><span class="required-field"> *</span>
                            @php( $types = \App\Models\InvoiceType::all())
                            <select class="form-select types" id="types" aria-label="Default select example">
                                @foreach($types as $type)
                                    <option
                                        value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
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
            <th scope="col">номер</th>
            <th scope="col">дата</th>
            <th scope="col">тип</th>
            <th scope="col">поставщик</th>
            <th scope="col">заказчик</th>
            <th scope="col">грузоотправитель</th>
            <th scope="col">грузополучатель</th>
            <th scope="col">статус</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $el)
            <tr>
                <td>{{$el->number}}</td>
                <td>{{$el->date}}</td>
                <td>{{$el->type->name}}</td>
                <td>{{$el->provider->name}}</td>
                <td>{{$el->customer->name}}</td>
                <td>{{$el->from}}</td>
                <td>{{$el->to}}</td>
                <td>{{$el->status->name}}</td>
                <td>
                    <button class="btn btn-warning show-product"><a
                            href="{{route('invoices.show', $el->id)}}">Просмотр</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$invoices->links()}}
    </div>

    <script type="text/javascript">
        $('#AddInvoice').on('submit', function (e) {
            e.preventDefault();
            let number = $('#number').val();
            let date = $('#date').val();
            let from = $('#from').val();
            let to = $('#to').val();
            let provider_id = $("#providers option:selected").val();
            let customer_id = $("#customers option:selected").val();
            let type_id = $("#types option:selected").val();
            let status_id = $("#statuses option:selected").val();
            console.log(to)
            $.ajax({
                url: "{{route('invoices.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    number: number,
                    date: date,
                    from: from,
                    to: to,
                    provider_id: provider_id,
                    customer_id: customer_id,
                    type_id: type_id,
                    status_id: status_id,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#createInvoiceErrors');
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
