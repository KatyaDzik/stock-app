@extends('layouts.user')

@section('doc-title')
    Управление продуктами
@endsection

@section('page-title')
    <h2>Управление продуктами</h2>
@endsection

@section('page-content')
    <div style="margin: 15px">
        <h4>
            Добавить продукт
        </h4>
        <div>
            <form id="AddProductToInvoice">
                <div
                    style="display: flex; justify-content: space-between; margin-top: 10px; border: 1px solid #a8a8a8; border-radius: 10px">
                    <div style="display: none; padding: 5px" id="addProductToInvoiceErrors"
                         class="alert alert-danger"></div>
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
                                <ul class="options" style="background: #e8e8e8; border-radius: 5px"></ul>
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
        </div>
    </div>
    <div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">наименование</th>
                <th scope="col">количество</th>
                <th scope="col">цена</th>
                <th scope="col">ндс %</th>
                <th scope="col">сумма</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $el)
                <tr>
                    <td>{{$el->product->name}}</td>
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
            @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $('#AddProductToInvoice').on('submit', function (e) {
            e.preventDefault();
            let count = $('#count').val();
            let price = $('#price').val();
            let nds = $('#nds').val();
            let product_id = $(".select-item")[0].id;
            let invoice_id = {{$id}};
            $.ajax({
                url: "{{route('manage.incoming.products.store', $id)}}",
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
                            });
                        }
                        errors_div[0].style.display = "block";
                    }
                },
            });
        })
    </script>
    <script type="text/javascript">
        const wrapper = document.querySelector(".wrapper"),
            selectBtn = wrapper.querySelector(".select-btn"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");
        const selectSpan = document.querySelector('.select-item');
        let products = new Map;

        function fillDataSelect() {
            @php($products =  \App\Models\Product::where('provider_id', $id)->get())
            let products = [];
            @foreach($products as $product)
            products.push({
                name: "{{$product->name}}",
                key: "{{$product->id}}",
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
            addCountry();
        }

        start();

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
@endsection
