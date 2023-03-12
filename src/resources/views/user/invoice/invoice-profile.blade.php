@extends('layouts.user')

@section('doc-title')
    Накладная №{{$invoice->number}}
@endsection

@section('page-title')
    <div style="display: flex; justify-content: space-between">
        <div style="display: flex; padding: 0px 20px 20px 0;">
            <h2 style="margin: 0; margin-right: 20px;">Накладная №{{$invoice->number}}</h2>
            <button class="btn-icon btn-open-modal" value="{{'update-invoice-'.$invoice->id}}"><img width="20px"
                                                                                                    src="{{ URL::asset('img/pen.png') }}"
                                                                                                    alt=""></button>
            <button class="btn-icon btn-open-modal" value="{{'delete-invoice-'.$invoice->id}}"
                    style="margin-left: 20px">
                <a><img
                        width="20px" src="{{ URL::asset('img/trash.png') }}" alt=""></a></button>
        </div>
        <button class="btn btn-primary" id="manage-products">Управление продуктами</button>
    </div>

    <x-modal-window id="{{'update-invoice-'.$invoice->id}}">
        <form style="margin: 20px;" id="UpdateInvoice">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="updateInvoiceErrors" class="alert alert-danger"></div>
            {{--         Форма   обновления накладной    --}}
            @csrf
            <div>
                <div style="display: flex; justify-content: space-between">

                    <div style="width: 50%">
                        <div class="form-group">
                            <label for="number">Номер</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="number" name="number"
                                   value="{{$invoice->number}}">
                        </div>
                        <div class="form-group">
                            <label for="from">Адрес грузоотправителя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="from" name="from"
                                   value="{{$invoice->from}}" {{$invoice->status->id === 1 ? '' : 'readonly'}}>
                        </div>
                        <div class="form-group">
                            <label for="to">Адрес грузополучателя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="to" name="to"
                                   value="{{$invoice->to}}" {{$invoice->status->id === 1 ? '' : 'readonly'}}>
                        </div>
                    </div>


                    <div style="width: 50%">
                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date"
                                   value="{{$invoice->date}}" {{$invoice->status->id === 1 ? '' : 'readonly'}}>
                        </div>
                        <div class="form-group">
                            <label for="customers">Заказчик</label><span class="required-field"> *</span>
                            @php( $customers = \App\Repositories\CustomerRepository::getAll())
                            <select class="form-select customers" id="customers" aria-label="Default select example">
                                @foreach($customers as $customer)
                                    <option
                                        value="{{$customer->id}}" {{$invoice->customer->id == $customer->id ? 'selected' : ''}} {{$invoice->status->id === 1 ? '' : 'readonly'}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="statuses">Статус</label><span class="required-field"> *</span>
                            @php( $statuses = \App\Repositories\StatusRepository::getAll())
                            <select class="form-select statuses" id="statuses" aria-label="Default select example">
                                @foreach($statuses as $status)
                                    <option
                                        value="{{$status->id}}" {{$invoice->status->id == $status->id ? 'selected' : ''}} {{$invoice->status->id === 1 ? '' : 'readonly'}}>{{$status->name}}</option>
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
    <x-modal-window id="{{'delete-invoice-'.$invoice->id}}">
        <h2>Действительно хотите удалить накладную {{$invoice->number}}</h2>
        <div class="modal-footer">
            <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                Закрыть
            </button>
            <button type="submit" style="margin: 10px" id="DeleteInvoice" class="btn btn-primary">Удалить</button>
        </div>
    </x-modal-window>

@endsection

@section('page-content')
    <div style="padding: 15px">
        <section class="invoice_info">
            <div style="display: flex; width: 60%; justify-content: space-between">
                <div>
                    <h5>Дата: <span style="font-weight: lighter">{{$invoice->date}}</span></h5>
                    <h5>Тип: <span style="font-weight: lighter">{{$invoice->type->name}}</span></h5>
                    <h5>Поставщик: <span style="font-weight: lighter">{{$invoice->provider->name}}</span></h5>
                    <h5>Заказчик: <span style="font-weight: lighter">{{$invoice->customer->name}}</span></h5>
                </div>
                <div>
                    <h5>Адрес грузоотправителя: <span style="font-weight: lighter">{{$invoice->from}}</span></h5>
                    <h5>Адрес грузополучателя: <span style="font-weight: lighter">{{$invoice->to}}</span></h5>
                    <h5>Статус: <span style="font-weight: lighter">{{$invoice->status->name}}</span></h5>
                    <h5>Состояние: <span
                            style="font-weight: lighter">{{$invoice->closed === 0 ? 'активно' : 'закрыто'}}</span></h5>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        $('#UpdateInvoice').on('submit', function (e) {
            e.preventDefault();
            let number = $('#number').val();
            let date = $('#date').val();
            let from = $('#from').val();
            let to = $('#to').val();
            let customer_id = $("#customers option:selected").val();
            let status_id = $("#statuses option:selected").val();
            $.ajax({
                url: "{{route('invoices.update', $invoice->id)}}",
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    number: number,
                    date: date,
                    from: from,
                    to: to,
                    customer_id: customer_id,
                    status_id: status_id,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#updateInvoiceErrors');
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
    <script type="text/javascript">
        $('#DeleteInvoice').on('click', function (e) {
            $.ajax({
                url: "{{route('invoices.destroy',  $invoice->id)}}",
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    location.href = "{{route('invoices')}}"
                },
                error: function (response) {
                    alert('There was some error performing the AJAX call!');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#manage-products').on('click', function (e) {
            @if($invoice->type->id == \App\Enums\TypeEnums::INCOMING)
            location.href = "{{route('manage.incoming.products', $invoice->id)}}";
            @endif
        });
    </script>
@endsection
