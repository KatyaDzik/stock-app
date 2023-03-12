@extends('layouts.user')

@section('doc-title')
    Накладная №{{$invoice->number}}
@endsection

@section('page-title')
    <div style="display: flex; padding: 0px 20px 20px 0;">
        <h2 style="margin: 0; margin-right: 20px;">Накладная №{{$invoice->number}}</h2>
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
                            <label for="date">Дата</label>
                            <input type="date" class="form-control" id="date" name="date"
                                   value="{{$invoice->date}}" {{$invoice->status->id === 1 ? '' : 'readonly'}}>
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
                            <label for="providers">Поставщик</label><span class="required-field"> *</span>
                            @php( $providers = \App\Repositories\ProviderRepository::getAll())
                            <select class="form-select providers" id="providers" aria-label="Default select example">
                                @foreach($providers as $provider)
                                    <option
                                        value="{{$provider->id}}" {{$invoice->provider->id == $provider->id ? 'selected' : ''}} {{$invoice->status->id === 1 ? '' : 'readonly'}}>{{$provider->name}}</option>
                                @endforeach
                            </select>
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
        <section style="margin-top: 30px;">
            <div style="display: flex; justify-content: space-between">
                <h4>Продукты</h4>
                @can('add products to invoice', $invoice)
                    @can('incoming invoice', $invoice)
                        <button class="btn btn-dark btn-open-modal" value="{{'add-product-to-incoming-invoice'}}"><a>Добавить</a>
                        </button>

                        {{--Форма обновления нового продукта--}}
                        <x-modal-window id="{{'add-product-to-incoming-invoice'}}">
                            {{--                    Блок для вывода добавленных товаров--}}
                            <div>
                                <div class="product-item" style="font-weight: bold; width: 50%; ">
                                    <p>название</p>
                                    <p>кол-во</p>
                                    <p>цена</p>
                                    <p>ндс</p>
                                </div>
                            </div>
                            <div id="addedProducts" style="border-bottom: 2px solid #acadac">
                            </div>
                            <form style="margin: 20px;" id="addProductToList">
                                {{--                    Блок для вывода ошибок--}}
                                <div style="display: none; padding: 5px" id="addProductToInvoiceErrors"
                                     class="alert alert-danger"></div>
                                {{--                    Форма добавления продукта в список--}}
                                @csrf
                                <div style="display: flex; justify-content: space-between; margin-top: 10px">
                                    <div>
                                        <div class="wrapper">
                                            <div class="select-btn">
                                                <span class="select-item">Выбрать продукт</span>
                                                <i class="uil uil-angle-down"></i>
                                            </div>
                                            <div class="content">
                                                <div class="search">
                                                    <i class="uil uil-search"></i>
                                                    <input spellcheck="false" type="text" placeholder="Search">
                                                </div>
                                                <ul class="options"></ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="count">Количество</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" id="count" name="count" min="1"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Цена</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" id="price" name="price" min="0.001"
                                               step=".001" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nds">НДС</label><span class="required-field"> *</span>
                                        <input type="number" class="form-control" id="nds" name="nds" min="1" required>
                                    </div>
                                    <button type="submit" style="margin: 30px; height: 50px" class="btn btn-primary">
                                        Добавить
                                    </button>

                                </div>
                            </form>
                            <div>
                                <div style="display: flex">
                                    <p style="font-size: small">Если необходимого продукта нет в списке, вы можете
                                        создать
                                        новый</p>
                                    <button type="button"
                                            class="btnPlus"
                                            style="background: white; margin: -2px 0 0px 10px; padding: 5px; height: 35px; border: 1px solid #0a58ca; color: #0a58ca; border-radius: 100%; width: 25px; height: 25px"
                                            id="createProductBtn">
                                    </button>
                                </div>
                                <div id="blockCreateProduct" class="mystyleBlock">
                                    <form style="margin: 20px;" id="CreateProduct">
                                        {{--     Блок для вывода ошибок       --}}
                                        <div style="display: none" id="createProductsErrors"
                                             class="alert alert-danger"></div>
                                        {{--         Форма       --}}
                                        @csrf
                                        <div>
                                            <div class="form-group">
                                                <label for="name">Название</label><span class="required-field"> *</span>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>

                                            <div class="form-group">
                                                <label for="category-name">Категория</label><span
                                                    class="required-field"> *</span>
                                                <input type="text" class="form-control" id="category-name"
                                                       name="category-name"
                                                       readonly>
                                            </div>

                                            <div class="form-group" style="display: none">
                                                <label for="category-id">Категория</label><span
                                                    class="required-field"> *</span>
                                                <input type="text" class="form-control" id="category-id"
                                                       name="category-id"
                                                       readonly>
                                            </div>

                                            <nav class="navbar">
                                                @php( $categories = \App\Repositories\CategoryRepository::getMainCategories())
                                                <ul class="navbar-nav categories">
                                                    @foreach($categories as $category)
                                                        @if(count($category->subcategories)>0)
                                                            <li class="nav-item"><a class="dropdown-toggle"
                                                                                    href="#">{{$category->name}}</a>
                                                                <ul class="dropdown categories">
                                                                    @foreach($category->subcategories as $subcategory)
                                                                        @if(count($subcategory->subcategories)>0)
                                                                            <li class="nav-item"><a
                                                                                    class="dropdown-toggle"
                                                                                    id="{{$subcategory->id}}"
                                                                                    value="{{$subcategory->name}}"
                                                                                    href="#">{{$subcategory->name}}</a>
                                                                                <ul class="dropdown categories">
                                                                                    <li><a href="#">Menu Item</a></li>
                                                                                    <li><a href="#">Menu</a></li>
                                                                                </ul>
                                                                            </li>
                                                                        @else
                                                                            <li class="nav-item"
                                                                                id="{{$subcategory->id}}"
                                                                                value="{{$subcategory->name}}">
                                                                                <a class="nav-link"
                                                                                   href="#">{{$subcategory->name}}</span></a>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @else
                                                            <li class="nav-item" id="{{$category->id}}"
                                                                value="{{$category->name}}">
                                                                <a class="nav-link"
                                                                   href="#">{{$category->name}}</span></a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </nav>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" style="margin: 10px"
                                                    class="btn btn-secondary btn-close-modal">
                                                Закрыть
                                            </button>
                                            <button type="submit" style="margin: 10px" class="btn btn-primary">Сохранить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                                    Закрыть
                                </button>
                                <button style="margin: 10px" id="saveProducts" class="btn btn-success">Сохранить
                                </button>
                            </div>
                        </x-modal-window>
                    @endcan
                    @can('outcoming invoice', $invoice)
                        <button class="btn btn-dark btn-open-modal" value="{{'add-product-to-outcoming-invoice'}}"><a>Добавить</a>
                        </button>

                        <x-modal-window id="{{'add-product-to-outcoming-invoice'}}">
                            <div>
                                <div id="addedProducts" style="border-bottom: 2px solid #acadac">
                                </div>
                                <form id="AddProductListOutcomingInvoice">
                                    <div style="display: flex; font-size: 15px">
                                        <div>
                                            <div class="wrapper">
                                                <div class="select-btn">
                                                    <span class="select-item">Выбрать продукт</span>
                                                    <i class="uil uil-angle-down"></i>
                                                </div>
                                                <div class="content">
                                                    <div class="search">
                                                        <i class="uil uil-search"></i>
                                                        <input spellcheck="false" type="text" placeholder="Search">
                                                    </div>
                                                    <ul class="options"></ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" style="width: 30%;">
                                            <label for="count">Количество</label><span class="required-field"> *</span>
                                            <input type="number" class="form-control" id="count" name="count" min="1"
                                                   required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Цена</label><span class="required-field"> *</span>
                                            <input type="number" class="form-control" id="price" name="price"
                                                   min="0.001"
                                                   step=".001" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="nds">НДС</label><span class="required-field"> *</span>
                                            <input type="number" class="form-control" id="nds" name="nds"
                                                   min="1"
                                                   required readonly>
                                        </div>

                                        <div class="form-group" style="width: 30%">
                                            <label for="percent">Процент реализации</label><span class="required-field"> *</span>
                                            <input type="number" class="form-control" id="percent" name="percent"
                                                   min="1"
                                                   required>
                                        </div>
                                        <button type="submit" style="margin: 30px; height: 50px"
                                                class="btn btn-primary">
                                            Добавить
                                        </button>
                                    </div>
                                </form>
                                <div class="modal-footer">
                                    <button type="button" style="margin: 10px"
                                            class="btn btn-secondary btn-close-modal">
                                        Закрыть
                                    </button>
                                    <button style="margin: 10px" id="saveProductsOutcomingInvoice"
                                            class="btn btn-success">Сохранить
                                    </button>
                                </div>
                            </div>
                        </x-modal-window>
                    @endcan
                @endcan
            </div>
            <div>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">наименование</th>
                        <th scope="col">номер</th>
                        <th scope="col">количество</th>
                        <th scope="col">цена</th>
                        <th scope="col">ндс %</th>
                        <th scope="col">сумма</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($producthasinvoice = \App\Models\ProductHasInvoices::where('invoice_id', $invoice->id)->get())
                    @foreach($producthasinvoice as $el)
                        <tr>
                            <td>{{$el->product->name}}</td>
                            <td>{{$el->product->sku}}</td>
                            <td>{{$el->count}}</td>
                            <td>{{round($el->price, 3)}}</td>
                            <td>{{$el->nds}}</td>
                            <td>{{($el->nds*$el->price)/100+$el->price}}</td>
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
                                                <label for="products">Продукты</label><span
                                                    class="required-field"> *</span>
                                                <select class="form-select products" id="{{'products'.$el->id}}"
                                                        aria-label="Default select example">
                                                    @php($products = \App\Models\Product::all())
                                                    @foreach($products as $product)
                                                        <option
                                                            value="{{$product->id}}" {{$product->id === $el->product->id ? 'selected' : ''}}>{{$product->name}} {{$product->sku}}</option>
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
                                    <button type="button" style="margin: 10px"
                                            class="btn btn-secondary btn-close-modal">
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
        </section>
    </div>
    @can('incoming invoice', $invoice)
        <script type="text/javascript">
            $('#addProductToList').on('submit', function (e) {
                e.preventDefault();
                const selectSpan = document.querySelector('.select-item');
                let parent_div = $('#addedProducts');
                let child_div = document.createElement("div");
                child_div.className = "product-item";
                let count_p = document.createElement('p');
                count_p.innerHTML = $('#count').val();
                let price_p = document.createElement('p');
                price_p.innerHTML = $('#price').val();
                let nds_p = document.createElement('p');
                nds_p.innerHTML = $('#nds').val();
                let product_p = document.createElement('p');
                product_p.innerHTML = selectSpan.innerText;
                product_p.setAttribute("id", selectSpan.id);
                // let delete_btn = document.createElement('button');
                // delete_btn.innerHTML = 'удалить';
                // delete_btn.className = "deleteFromListBtn";
                child_div.append(product_p);
                child_div.append(count_p);
                child_div.append(price_p);
                child_div.append(nds_p);
                // child_div.append(delete_btn);
                parent_div.append(child_div);
            });
        </script>
        <script type="text/javascript">
            const wrapper = document.querySelector(".wrapper"),
                selectBtn = wrapper.querySelector(".select-btn"),
                searchInp = wrapper.querySelector("input"),
                options = wrapper.querySelector(".options");
            const selectSpan = document.querySelector('.select-item');
            let products = new Map;
            let products1 = [];

            function fillDataSelect2() {
                @php($products = \App\Models\Product::all())
                let products1 = [];
                @foreach($products as $product)
                products1.push({name: "{{$product->name}}", key: "{{$product->id}}"});
                @endforeach
            }

            function fillDataSelect1() {
                @php($products = \App\Models\Product::all())
                let products;
                products = new Map([
                        @foreach($products as $product)
                    ['{{$product->id}}', "{{$product->name}}"],
                    @endforeach
                ]);

                return products;
            }


            function addCountry(selectedProduct) {
                options.innerHTML = "";
                products.forEach(function (value, key) {
                    let isSelected = value == selectedProduct ? "selected" : "";
                    let li = `<li onclick="updateName(this)" value="${key}" class="${isSelected}">${value}</li>`;
                    options.insertAdjacentHTML("beforeend", li);
                });
            }

            function start() {
                products = fillDataSelect1();
                products1 = fillDataSelect2();
                addCountry();
                displayVals();
            }

            start();

            function displayVals() {
                $.ajax({
                    type: "GET",
                    url: '/newproducts',
                    success: function (response) {
                        console.log(response);
                    }
                });
            }

            function updateName(selectedLi) {
                searchInp.value = "";
                addCountry(selectedLi.innerText);
                wrapper.classList.remove("active");
                selectBtn.firstElementChild.innerText = selectedLi.innerText;
                selectSpan.setAttribute('id', selectedLi.value);
            }

            searchInp.addEventListener("keyup", () => {
                let arr = [];
                let searchWord = searchInp.value.toLowerCase();
                arr = products1.filter(data => {
                    return data["name"].toLowerCase().startsWith(searchWord);
                }).map(data => {
                    let isSelected = data["name"] == selectBtn.firstElementChild.innerText ? "selected" : "";
                    return `<li onclick="updateName(this)" value="${data['key']}" class="${isSelected}">${data["name"]}</li>`;
                }).join("");
                options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">продукт не найден</p>`;
            });
            selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"))
        </script>
        {{--        <script type="text/javascript">--}}
        {{--            function displayVals()--}}
        {{--            {--}}
        {{--                $.ajax({--}}
        {{--                    type: "GET",--}}
        {{--                    url: '/newproducts',--}}
        {{--                    success:function(response)--}}
        {{--                    {--}}
        {{--                        console.log(JSON.parse(response));--}}
        {{--                    }--}}
        {{--                });--}}
        {{--            }--}}
        {{--        </script>--}}
        <script type="text/javascript">
            $('#saveProducts').on('click', function () {
                dataarr = [];
                var children = [].slice.call(document.getElementById('addedProducts').children);
                children.forEach((element) => {
                        el = [].slice.call(element.children);
                        let obj = {
                            product_id: el[0].id,
                            count: el[1].innerText,
                            price: el[2].innerText,
                            nds: el[3].innerText
                        };
                        dataarr.push(obj);
                    }
                );
                $.ajax({
                    url: "{{route('add.products.to.invoice', $invoice->id)}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        data: JSON.stringify(dataarr),
                    },
                    success: function (response) {
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
    @endcan

    @can('outcoming invoice', $invoice)
        <script>
            $('#AddProductListOutcomingInvoice').on('submit', function (e) {
                e.preventDefault();
                const selectSpan = document.querySelector('.select-item');
                let parent_div = $('#addedProducts');
                let child_div = document.createElement("div");
                child_div.className = "product-item";
                let count_p = document.createElement('p');
                count_p.innerHTML = $('#count').val();
                let price_p = document.createElement('p');
                price_p.innerHTML = $('#price').val();
                let nds_p = document.createElement('p');
                nds_p.innerHTML = $('#nds').val();
                let percent_p = document.createElement('p');
                percent_p.innerHTML = $('#percent').val();
                let product_p = document.createElement('p');
                product_p.innerHTML = selectSpan.innerText;
                product_p.setAttribute("id", selectSpan.id);
                child_div.append(product_p);
                child_div.append(count_p);
                child_div.append(price_p);
                child_div.append(nds_p);
                child_div.append(percent_p);
                // child_div.append(delete_btn);
                parent_div.append(child_div);
            });
        </script>
        <script>
            $('#saveProductsOutcomingInvoice').on('click', function () {
                dataarr = [];
                var children = [].slice.call(document.getElementById('addedProducts').children);
                children.forEach((element) => {
                        el = [].slice.call(element.children);
                        let obj = {
                            product_id: el[0].id,
                            count: el[1].innerText,
                            price: el[2].innerText,
                            nds: el[3].innerText,
                            percent: el[4].innerText,
                        };
                        dataarr.push(obj);
                    }
                );
                console.log(dataarr);
                $.ajax({
                    url: "{{route('add.products.to.outcoming.invoice', $invoice->id)}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        data: JSON.stringify(dataarr),
                    },
                    success: function (response) {
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
            const wrapper = document.querySelector(".wrapper"),
                selectBtn = wrapper.querySelector(".select-btn"),
                searchInp = wrapper.querySelector("input"),
                options = wrapper.querySelector(".options");
            const selectSpan = document.querySelector('.select-item');
            let products = new Map;

            function fillDataSelect() {
                @php($products =  \App\Models\Product::has('stocks')->get())
                let products = [];
                @foreach($products as $product)
                @php($has_invoice = \App\Models\ProductHasInvoices::where('product_id', $product->id)->first())
                @php($count_in_stock = \App\Models\ProductHasStocks::where('product_id', $product->id)->sum('count'))
                products.push({
                    name: "{{$product->name}}",
                    key: "{{$product->id}}",
                    price: "{{round($has_invoice->price, 3)}}",
                    nds: "{{$has_invoice->nds}}",
                    count: "{{$count_in_stock}}"
                });
                @endforeach

                    return products;
            }

            function addCountry(selectedProduct) {
                options.innerHTML = "";
                products.forEach(function (value) {
                    let isSelected = value == selectedProduct ? "selected" : "";
                    let li = `<li onclick="updateName(this)" value="${value['key']}" class="${isSelected}">${value['name']}</li>`;
                    options.insertAdjacentHTML("beforeend", li);
                });
            }

            function start() {
                products = fillDataSelect();
                console.log(products);
                addCountry();
            }

            start();

            function updateName(selectedLi) {
                searchInp.value = "";
                addCountry(selectedLi.innerText);
                wrapper.classList.remove("active");
                selectBtn.firstElementChild.innerText = selectedLi.innerText;
                selectSpan.setAttribute('id', selectedLi.value);
                console.log(selectedLi.value)
                let result = products.filter(obj => {
                    return obj.key == selectedLi.value
                })

                $('#count').val(result[0].count);
                $('#count').attr({
                    "max": result[0].count,        // substitute your own
                });
                $('#price').val(result[0].price);
                $('#nds').val(result[0].nds);

                console.log(result[0].count);
            }

            searchInp.addEventListener("keyup", () => {
                let arr = [];
                let searchWord = searchInp.value.toLowerCase();
                arr = products.filter(data => {
                    return data["name"].toLowerCase().startsWith(searchWord);
                }).map(data => {
                    let isSelected = data["name"] == selectBtn.firstElementChild.innerText ? "selected" : "";
                    return `<li onclick="updateName(this)" value="${data['key']}" class="${isSelected}">${data["name"]}</li>`;
                }).join("");
                options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">продукт не найден</p>`;
            });
            selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"))
        </script>
    @endcan

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
    <script type="text/javascript">
        $(".categories li").click(function () {
            let id = $(this).attr('id');
            let category = $(this).attr('value');
            if (typeof (category) !== 'undefined') {
                $("#category-name").val(category);
                $("#category-id").val(id);
            }
        });
    </script>

    <script>
        $(function () { // Dropdown toggle
            $('.dropdown-toggle').click(function () {
                $(this).next('.dropdown').slideToggle();
            });

            $(document).click(function (e) {
                var target = e.target;
                if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
                    $('.dropdown').slideUp();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#CreateProduct').on('submit', function (e) {
            e.preventDefault();
            let name = $("#name").val();
            let category_id = $("#category-id").val();
            $.ajax({
                url: "{{route('products.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    category_id: category_id,
                },
                success: function (response) {
                    console.log(response);
                    start();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#createProductsErrors');
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
    <script>
        $('#createProductBtn').on('click', function (e) {
            let element = document.getElementById("blockCreateProduct");
            element.classList.toggle("mystyleBlock");
        });
    </script>
    <script type="text/javascript">
        // $('.deleteFromListBtn').on('click', function (e) {
        //     console.log('click');
        // });
        document.querySelectorAll('.deleteFromListBtn').forEach(w => {
            w.addEventListener('click', _ => {
                console.log('kkk');
            })
        })
    </script>
@endsection
