@extends('layouts.user')

@section('doc-title')
    Поступления товаров
@endsection

@section('page-title')
    Ожидают распределения
@endsection

@section('page-content')
    <div>
        @php($stocklist = \App\Models\Stock::all())
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
                                value="{{'delete-product-for-stock-'.$el->id}}">Удалить
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-success btn-open-modal"
                                value="{{'assign-stock-to-product-'.$el->id}}">Добавить
                        </button>
                    </td>

                    <x-modal-window id="{{'assign-stock-to-product-'.$el->id}}">
                        <form style="margin: 20px;" class="AddProductToStock" id="{{$el->id}}">
                            {{--     Блок для вывода ошибок       --}}
                            <div style="display: none" id="addProductToStockErrors"
                                 class="alert alert-danger"></div>
                            {{--         Форма       --}}
                            @csrf
                            <div>
                                <div>
                                    <div class="form-group">
                                        <label for="stocks">Склады</label><span class="required-field"> *</span>
                                        <select class="form-select stocks" id="{{'stocks'.$el->id}}"
                                                aria-label="Default select example">
                                            @foreach($stocklist as $stock)
                                                <option
                                                    value="{{$stock->id}}">{{$stock->name}}
                                                    - {{$stock->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @php($product = \App\Models\Product::where('id', $el->product_id)->first())
                                <div class="form-group">
                                    <label for="product">Продукт</label><span class="required-field"> *</span>
                                    <input type="text" class="form-control" value="{{$product->name}}" readonly
                                           name="product">
                                    <input type="text" style="display: none" class="form-control"
                                           value="{{$product->id}}" readonly
                                           id="{{'product_id'.$el->id}}" name="product">
                                </div>

                                <div class="form-group">
                                    <label for="count">Количество</label><span class="required-field"> *</span>
                                    <input type="number" class="form-control" value="{{$el->count}}" readonly
                                           id="{{'count'.$el->id}}" name="count" min="1">
                                </div>

                                <div class="form-group">
                                    <label for="price">Цена</label><span class="required-field"> *</span>
                                    <input type="number" class="form-control" id="{{'price'.$el->id}}" readonly
                                           value="{{$el->price}}" name="price" min="0.001" step=".001">
                                </div>

                                <div class="form-group">
                                    <label for="nds">НДС</label><span class="required-field"> *</span>
                                    <input type="number" class="form-control" value="{{$el->nds}}" readonly
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

                    <x-modal-window id="{{'delete-product-for-stock-'.$el->id}}">
                        <h2>Действительно хотите удалить</h2>
                        <div class="modal-footer">
                            <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                                Закрыть
                            </button>
                            <button type="submit" style="margin: 10px" value="{{$el->id}}"
                                    class="btn btn-primary DeleteProductFromStock">Удалить
                            </button>
                        </div>
                    </x-modal-window>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            {{$products->links()}}
        </div>
    </div>
    <script type="text/javascript">
        $('.AddProductToStock').on('submit', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let count = $('#count' + id).val();
            let price = $('#price' + id).val();
            let nds = $('#nds' + id).val();
            let product_id = $('#product_id' + id).val();
            let stock_id = $("#stocks" + id + " option:selected").val();
            $.ajax({
                url: "{{route('add.product.to.stock.from.received.goods', '')}}" + "/" + id,
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
        document.querySelectorAll('.DeleteProductFromStock').forEach(w => {
            w.addEventListener('click', _ => {
                let id = w.value;
                $.ajax({
                    url: "{{route('delete.product.for.stock', '')}}" + "/" + id,
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
