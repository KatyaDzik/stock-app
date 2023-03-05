@extends('layouts.user')

@section('doc-title')
    Продукция на складе
@endsection

@section('page-title')
    @php($stock = \App\Models\Stock::where('id', $id)->first())
    @php($productslist = \App\Models\Product::all())
    <div style="display: flex; padding: 0px 20px 20px 0;">
        <h2>Продукция на {{$stock->name}} складе</h2>
        <button class="btn-icon btn-open-modal" value="{{'update-stock-'.$stock->id}}"><img width="20px"
                                                                                            src="{{ URL::asset('img/pen.png') }}"
                                                                                            alt=""></button>
        <button class="btn-icon btn-open-modal" value="{{'delete-stock-'.$stock->id}}" style="margin-left: 20px">
            <a><img
                    width="20px" src="{{ URL::asset('img/trash.png') }}" alt=""></a></button>
    </div>

    <x-modal-window id="{{'update-stock-'.$stock->id}}">
        <form style="margin: 20px;" id="UpdateStock">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="updateStockErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div class="form-group">
                    <label for="namestock">Наименование</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="namestock" name="namestock"
                           value="{{$stock->name}}">
                </div>

                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="{{$stock->address}}">
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
    <x-modal-window id="{{'delete-stock-'.$stock->id}}">
        <h2>Действительно хотите удалить склад {{$stock->name}}</h2>
        <div class="modal-footer">
            <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                Закрыть
            </button>
            <button type="submit" style="margin: 10px" id="DeleteStock" class="btn btn-primary">Удалить</button>
        </div>
    </x-modal-window>
@endsection

@section('page-content')
    <div>
        <div style="display: flex; justify-content: space-between">
            <h2>Продукты</h2>
            <button class="btn btn-dark btn-open-modal" value="{{'add-product-to-stock'}}"><a>Добавить</a></button>
            <x-modal-window id="{{'add-product-to-stock'}}">
                <form style="margin: 20px;" id="AddProductToStock">
                    {{--     Блок для вывода ошибок       --}}
                    <div style="display: none" id="addProductToStockErrors" class="alert alert-danger"></div>
                    {{--         Форма       --}}
                    @csrf
                    <div>
                        <div>
                            <div class="form-group">
                                <label for="products">Продукты</label><span class="required-field"> *</span>
                                <select class="form-select products" id="products"
                                        aria-label="Default select example">
                                    @foreach($productslist as $product)
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
            @foreach($products as $el)
                <tr>
                    <td>{{$el->product->name}}</td>
                    <td>{{$el->count}}</td>
                    <td>{{round($el->price, 3)}}</td>
                    <td>{{$el->nds}}</td>
                    <td>
                        <button class="btn btn-warning btn-open-modal"
                                value="{{'delete-product-from-stock-'.$el->id}}">Удалить
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-success btn-open-modal"
                                value="{{'update-product-from-stock-'.$el->id}}">Редактировать
                        </button>
                    </td>

                    <x-modal-window id="{{'update-product-from-stock-'.$el->id}}">
                        <form style="margin: 20px;" class="UpdateProductToStock" id="{{$el->id}}">
                            {{--     Блок для вывода ошибок       --}}
                            <div style="display: none" id="updateProductToStockErrors"
                                 class="alert alert-danger"></div>
                            {{--         Форма       --}}
                            @csrf
                            <div>
                                <div>
                                    <div class="form-group">
                                        <label for="products">Продукты</label><span class="required-field"> *</span>
                                        <select class="form-select products" id="{{'products'.$el->id}}"
                                                aria-label="Default select example">
                                            @foreach($productslist as $product)
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
                                        class="btn btn-primary UpdateProductFromStock">Сохранить
                                </button>
                            </div>
                        </form>
                    </x-modal-window>

                    <x-modal-window id="{{'delete-product-from-stock-'.$el->id}}">
                        <h2>Действительно хотите удалить {{$el->product->name}}</h2>
                        <div class="modal-footer">
                            <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                                Закрыть
                            </button>
                            <input style="display: none" id="delete-value" type="text" value={{$el->id}}>
                            <button type="submit" style="margin: 10px" value="{{$el->id}}"
                                    class="btn btn-primary DeleteProductFromStock">Удалить
                            </button>
                        </div>
                    </x-modal-window>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $('#UpdateStock').on('submit', function (e) {
            e.preventDefault();
            let name = $('#namestock').val();
            let address = $('#address').val();
            $.ajax({
                url: "{{route('stocks.update', $stock->id)}}",
                type: "PUT",
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
                        let errors_div = $('#updateStockErrors');
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
        $('#DeleteStock').on('click', function (e) {
            $.ajax({
                url: "{{route('stocks.destroy',  $stock->id)}}",
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    location.href = "{{route('stocks')}}"
                },
                error: function (response) {
                    alert('There was some error performing the AJAX call!');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#AddProductToStock').on('submit', function (e) {
            e.preventDefault();
            let count = $('#count').val();
            let price = $('#price').val();
            let nds = $('#nds').val();
            let product_id = $("#products option:selected").val();
            let stock_id = {{$stock->id}};
            $.ajax({
                url: "{{route('add.product.to.stock')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    count: count,
                    price: price,
                    nds: nds,
                    product_id: product_id,
                    stock_id: stock_id,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#addProductToStockErrors');
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
        $('.UpdateProductToStock').on('submit', function (e) {
            console.log('hhh');
            e.preventDefault();
            let id = $(this).attr('id');
            let count = $('#count' + id).val();
            let price = $('#price' + id).val();
            let nds = $('#nds' + id).val();
            let product_id = $("#products" + id + " option:selected").val();
            let stock_id = {{$stock->id}};
            $.ajax({
                url: "{{route('update.product.from.stock', '')}}" + "/" + id,
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    count: count,
                    price: price,
                    nds: nds,
                    product_id: product_id,
                    stock_id: stock_id,
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    let obj = JSON.parse(response.responseText);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#updateProductToStockErrors');
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
        document.querySelectorAll('.DeleteProductFromStock').forEach(w => {
            w.addEventListener('click', _ => {
                let id = w.value;
                $.ajax({
                    url: "{{route('delete.product.from.stock', '')}}" + "/" + id,
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
@endsection
