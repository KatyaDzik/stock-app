@extends('layouts.user')

@section('doc-title')
    Накладная {{$invoice->number}}
@endsection

@section('page-title')
    <div style="display: flex; padding: 0px 20px 20px 0;">
        <h2 style="margin: 0; margin-right: 20px;">{{$invoice->number}}</h2>
        <button class="btn-icon btn-open-modal" value="{{'update-invoice-'.$invoice->id}}"><img width="20px"
                                                                                                src="{{ URL::asset('img/pen.png') }}"
                                                                                                alt=""></button>
        <button class="btn-icon btn-open-modal" value="{{'delete-invoice-'.$invoice->id}}" style="margin-left: 20px">
            <a><img
                    width="20px" src="{{ URL::asset('img/trash.png') }}" alt=""></a></button>
    </div>

    <x-modal-window id="{{'update-invoice-'.$invoice->id}}">
        <form style="margin: 20px;" id="UpdateInvoice">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="updateInvoiceErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div style="display: flex; justify-content: space-between">
                    <div>
                        <div class="form-group">
                            <label for="number">Номер</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="number" name="number"
                                   value="{{$invoice->number}}">
                        </div>

                        <div class="form-group">
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date"
                                   value="{{$invoice->date}}">
                        </div>

                        <div class="form-group">
                            <label for="from">Адрес грузоотправителя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="from" name="from" value="{{$invoice->from}}">
                        </div>

                        <div class="form-group">
                            <label for="to">Адрес грузополучателя</label><span class="required-field"> *</span>
                            <input type="text" class="form-control" id="to" name="to" value="{{$invoice->to}}">
                        </div>

                    </div>

                    <div>
                        <div class="form-group">
                            <label for="providers">Поставщик</label><span class="required-field"> *</span>
                            @php( $providers = \App\Repositories\ProviderRepository::getAll())
                            <select class="form-select providers" id="providers" aria-label="Default select example">
                                @foreach($providers as $provider)
                                    <option
                                        value="{{$provider->id}}" {{$invoice->provider->id == $provider->id ? 'selected' : ''}}>{{$provider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customers">Заказчик</label><span class="required-field"> *</span>
                            @php( $customers = \App\Repositories\CustomerRepository::getAll())
                            <select class="form-select customers" id="customers" aria-label="Default select example">
                                @foreach($customers as $customer)
                                    <option
                                        value="{{$customer->id}}" {{$invoice->customer->id == $customer->id ? 'selected' : ''}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="statuses">Статус</label><span class="required-field"> *</span>
                            @php( $statuses = \App\Repositories\StatusRepository::getAll())
                            <select class="form-select statuses" id="statuses" aria-label="Default select example">
                                @foreach($statuses as $status)
                                    <option
                                        value="{{$status->id}}" {{$invoice->status->id == $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="types">Тип</label><span class="required-field"> *</span>
                            @php( $types = \App\Models\InvoiceType::all())
                            <select class="form-select types" id="types" aria-label="Default select example">
                                @foreach($types as $type)
                                    <option
                                        value="{{$type->id}}" {{$invoice->type->id == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
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
        <div style="display: flex; justify-content: space-between">
            <h2>Продукты</h2>
            <button class="btn btn-dark btn-open-modal" value="{{'add-product-to-invoice'}}"><a>Добавить</a></button>
            <x-modal-window id="{{'add-product-to-invoice'}}">
                <form style="margin: 20px;" id="AddProductToInvoice">
                    {{--     Блок для вывода ошибок       --}}
                    <div style="display: none" id="addProductToInvoiceErrors" class="alert alert-danger"></div>
                    {{--         Форма       --}}
                    @csrf
                    <div>
                        <div>
                            <div class="form-group">
                                <label for="products">Продукты</label><span class="required-field"> *</span>
                                @php( $products = \App\Models\Product::all())
                                <select class="form-select products" id="products"
                                        aria-label="Default select example">
                                    @foreach($products as $product)
                                        <option
                                            value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="count">Количество</label><span class="required-field"> *</span>
                            <input type="number" class="form-control" id="count" name="count" min="1">
                        </div>

                        <div class="form-group">
                            <label for="price">Цена</label><span class="required-field"> *</span>
                            <input type="number" class="form-control" id="price" name="price" min="0.001" step=".001">
                        </div>

                        <div class="form-group">
                            <label for="nds">НДС</label><span class="required-field"> *</span>
                            <input type="number" class="form-control" id="nds" name="nds" min="1">
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
        </div>
        <div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">наименование</th>
                    <th scope="col">количество</th>
                    <th scope="col">цена</th>
                    <th scope="col">ндс %</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @php($producthasinvoice = \App\Models\ProductHasInvoices::where('invoice_id', $invoice->id)->get())
                @foreach($producthasinvoice as $el)
                    <tr>
                        <td>{{$el->product->name}}</td>
                        <td>{{$el->count}}</td>
                        <td>{{round($el->price, 3)}}</td>
                        <td>{{$el->nds}}</td>
                        <td>
                            <button class="btn btn-warning btn-open-modal"
                                    value="{{'delete-product-from-invoice-'.$el->id}}">Удалить
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-success btn-open-modal"
                                    value="{{'update-product-from-invoice-'.$el->id}}">Редактировать
                            </button>
                        </td>

                        <x-modal-window id="{{'update-product-from-invoice-'.$el->id}}">
                            <form style="margin: 20px;" class="UpdateProductToInvoice" id="{{$el->id}}">
                                {{--     Блок для вывода ошибок       --}}
                                <div style="display: none" id="updateProductToInvoiceErrors"
                                     class="alert alert-danger"></div>
                                {{--         Форма       --}}
                                @csrf
                                <div>
                                    <div>
                                        <div class="form-group">
                                            <label for="products">Продукты</label><span class="required-field"> *</span>
                                            <select class="form-select products" id="{{'products'.$el->id}}"
                                                    aria-label="Default select example">
                                                @foreach($products as $product)
                                                    <option
                                                        value="{{$product->id}}" {{$product->id === $el->product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="count">Количество</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" value="{{$el->count}}"
                                               id="{{'count'.$el->id}}" name="count" min="1">
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Цена</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" id="{{'price'.$el->id}}"
                                               value="{{$el->price}}" name="price" min="0.001" step=".001">
                                    </div>

                                    <div class="form-group">
                                        <label for="nds">НДС</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" value="{{$el->nds}}"
                                               id="{{'nds'.$el->id}}" name="nds" min="1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="margin: 10px"
                                            class="btn btn-secondary btn-close-modal">
                                        Закрыть
                                    </button>
                                    <button type="submit" style="margin: 10px" value="{{$el->id}}"
                                            class="btn btn-primary UpdateProductFromInvoice">Сохранить
                                    </button>
                                </div>
                            </form>
                        </x-modal-window>

                        <x-modal-window id="{{'delete-product-from-invoice-'.$el->id}}">
                            <h2>Действительно хотите удалить {{$el->product->name}}</h2>
                            <div class="modal-footer">
                                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                                    Закрыть
                                </button>
                                <input style="display: none" id="delete-value" type="text" value={{$el->id}}>
                                <button type="submit" style="margin: 10px" value="{{$el->id}}"
                                        class="btn btn-primary DeleteProductFromInvoice">Удалить
                                </button>
                            </div>
                        </x-modal-window>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script type="text/javascript">
        $('#UpdateInvoice').on('submit', function (e) {
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
                url: "{{route('invoices.update', $invoice->id)}}",
                type: "PUT",
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
                    console.log(response);
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
        $('#AddProductToInvoice').on('submit', function (e) {
            e.preventDefault();
            let count = $('#count').val();
            let price = $('#price').val();
            let nds = $('#nds').val();
            let product_id = $("#products option:selected").val();
            let invoice_id = {{$invoice->id}};
            $.ajax({
                url: "{{route('add.product.to.invoice')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    count: count,
                    price: price,
                    nds: nds,
                    product_id: product_id,
                    invoice_id: invoice_id,
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#addProductToInvoiceErrors');
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
        document.querySelectorAll('.DeleteProductFromInvoice').forEach(w => {
            w.addEventListener('click', _ => {
                let id = w.value;
                $.ajax({
                    url: "{{route('delete.product.from.invoice', '')}}" + "/" + id,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (response) {
                        alert('There was some error performing the AJAX call!');
                    },
                });
            })
        })
    </script>
    <script type="text/javascript">
        $('.UpdateProductToInvoice').on('submit', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let count = $('#count' + id).val();
            let price = $('#price' + id).val();
            let nds = $('#nds' + id).val();
            let product_id = $("#products" + id + " option:selected").val();
            let invoice_id = {{$invoice->id}};
            $.ajax({
                url: "{{route('update.product.from.invoice', '')}}" + "/" + id,
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    count: count,
                    price: price,
                    nds: nds,
                    product_id: product_id,
                    invoice_id: invoice_id,
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#updateProductToInvoiceErrors');
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
