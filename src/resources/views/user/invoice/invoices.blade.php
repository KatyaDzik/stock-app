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
                    <div style="width: 50%">
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

                    <div style="width: 50%">

                        <div>
                            <div class="wrapper wrapprovider" style="width: auto; margin: 15px 0 40px 0">
                                <div class="select-btn select-btn-provider" style="padding: 0 10px">
                                    <label for="provider-name" style="color: black">Поставщик</label><span
                                        class="required-field"> *</span>
                                    <input type="text" id="provider-name" autocomplete="off"
                                           class="form-control select-item select-item-provider">
                                    <i class="uil uil-angle-down"></i>
                                </div>
                                <div class="content">
                                    <div class="search">
                                        <i class="uil uil-search"></i>
                                        <input spellcheck="false" autocomplete="off" class="search-input-provider"
                                               type="text"
                                               placeholder="Search">
                                    </div>
                                    <ul class="options options-provider" style="position: static"></ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="wrapper wrapcustomer" style="width: auto; margin: 15px 0 40px 0">
                                <div class="select-btn select-btn-customer" style="padding: 0 10px">
                                    <label for="customer-name" style="color: black">customer</label><span
                                        class="required-field"> *</span>
                                    <input type="text" id="customer-name" autocomplete="off"
                                           class="form-control select-item select-item-customer">
                                    <i class="uil uil-angle-down"></i>
                                </div>
                                <div class="content">
                                    <div class="search">
                                        <i class="uil uil-search"></i>
                                        <input spellcheck="false" autocomplete="off" class="search-input-customer"
                                               type="text"
                                               placeholder="Search">
                                    </div>
                                    <ul class="options options-customer" style="position: static"></ul>
                                </div>
                            </div>
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
                <buttonbutton type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                    Закрыть
                </buttonbutton>
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
            let provider = $('#provider-name').val();
            let customer = $('#customer-name').val();
            let type_id = $("#types option:selected").val();
            $.ajax({
                url: "{{route('invoices.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    number: number,
                    date: date,
                    from: from,
                    to: to,
                    provider: provider,
                    customer: customer,
                    type_id: type_id,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    console.log(response);
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
    <script type="text/javascript">
        const wrapprovider = document.querySelector(".wrapprovider"),
            selectBtnProvider = wrapprovider.querySelector(".select-btn-provider"),
            searchInpProvider = wrapprovider.querySelector(".search-input-provider"),
            optionsProvider = wrapprovider.querySelector(".options-provider");
        const selectSpanProvider = document.querySelector('.select-item-provider');
        let providers = new Map;

        function fillDataSelect() {
            @php($providers = \App\Models\Provider::all())
            let providers = [];
            @foreach($providers as $provider)
            providers.push({
                name: "{{$provider->name}}",
                key: "{{$provider->id}}",
            });
            @endforeach
                return providers;
        }

        function addDataToList(selectedProduct) {
            optionsProvider.innerHTML = "";
            providers.forEach(function (value) {
                let isSelected = value == selectedProduct ? "selected" : "";
                let li = `<li onclick="updateName(this)" value="${value['key']}" class="${isSelected}">${value['name']}</li>`;
                optionsProvider.insertAdjacentHTML("beforeend", li);
            });
        }

        function start() {
            providers = fillDataSelect();
            addDataToList();
        }

        start();

        function updateName(selectedLi) {
            searchInpProvider.value = "";
            addDataToList(selectedLi.innerText);
            wrapprovider.classList.remove("active");
            $("#provider-name").val(selectedLi.innerText);
            let result = providers.filter(obj => {
                return obj.key == selectedLi.value
            })
        }

        searchInpProvider.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInpProvider.value.toLowerCase();
            arr = providers.filter(data => {
                return data["name"].toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data["name"] == selectBtnProvider.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateName(this)" value="${data['key']}" class="${isSelected}">${data["name"]}</li>`;
            }).join("");
            optionsProvider.innerHTML = arr ? arr : `<p style="margin-top: 10px;">продукт не найден</p>`;
        });
        selectBtnProvider.addEventListener("click", () => wrapprovider.classList.toggle("active"))
    </script>
    <script type="text/javascript">
        const wrapcustomer = document.querySelector(".wrapcustomer"),
            selectBtnCustomer = wrapcustomer.querySelector(".select-btn-customer"),
            searchInpCustomer = wrapcustomer.querySelector(".search-input-customer"),
            optionsCustomers = wrapcustomer.querySelector(".options-customer");
        const selectSpanCustomer = document.querySelector('.select-item-customer');
        let customers = new Map;

        function fillDataSelectCustomer() {
            @php($customers = \App\Models\Customer::all())
            let customers = [];
            @foreach($customers as $customer)
            customers.push({
                name: "{{$customer->name}}",
                key: "{{$customer->id}}",
            });
            @endforeach
                return customers;
        }

        function addDataToListCustomer(selectedProduct) {
            optionsCustomers.innerHTML = "";
            customers.forEach(function (value) {
                let isSelected = value == selectedProduct ? "selected" : "";
                let li = `<li onclick="updateNameCustomer(this)" value="${value['key']}" class="${isSelected}">${value['name']}</li>`;
                optionsCustomers.insertAdjacentHTML("beforeend", li);
            });
        }

        function start1() {
            customers = fillDataSelectCustomer();
            addDataToListCustomer();
        }

        start1();

        function updateNameCustomer(selectedLi) {
            searchInpCustomer.value = "";
            addDataToList(selectedLi.innerText);
            wrapcustomer.classList.remove("active");
            $("#customer-name").val(selectedLi.innerText);
            let result = customers.filter(obj => {
                return obj.key == selectedLi.value
            })
        }

        searchInpCustomer.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInpCustomer.value.toLowerCase();
            arr = customers.filter(data => {
                return data["name"].toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data["name"] == selectBtnCustomer.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateNameCustomer(this)" value="${data['key']}" class="${isSelected}">${data["name"]}</li>`;
            }).join("");
            optionsCustomers.innerHTML = arr ? arr : `<p style="margin-top: 10px;">продукт не найден</p>`;
        });
        selectBtnCustomer.addEventListener("click", () => wrapcustomer.classList.toggle("active"))
    </script>
@endsection
