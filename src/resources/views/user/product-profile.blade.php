@extends('layouts.user')

@section('doc-title')
    {{$product->name}}
@endsection

@section('page-title')
    <div style="display: flex; padding: 0px 20px 20px 0;">
        <h2 style="margin: 0; margin-right: 20px;">{{$product->name}}</h2>
        <button class="btn-icon btn-open-modal" value="{{'update-product-'.$product->id}}"><img width="20px"
                                                                                                src="{{ URL::asset('img/pen.png') }}"
                                                                                                alt=""></button>
        <button class="btn-icon btn-open-modal" value="{{'delete-product-'.$product->id}}" style="margin-left: 20px">
            <a><img
                    width="20px" src="{{ URL::asset('img/trash.png') }}" alt=""></a></button>

        <x-modal-window id="{{'update-product-'.$product->id}}">
            <form style="margin: 20px;" id="UpdateProduct">
                {{--     Блок для вывода ошибок       --}}
                <div style="display: none" id="updateProductsErrors" class="alert alert-danger"></div>
                {{--         Форма   обновления накладной    --}}
                @csrf
                <div>
                    <div class="form-group">
                        <label for="name">Название</label><span class="required-field"> *</span>
                        <input type="text" class="form-control" id="name" value="{{$product->name}}" name="name">
                    </div>

                    <div class="form-group" style="display: none">
                        <label for="category-id">Категория</label><span class="required-field"> *</span>
                        <input type="text" class="form-control" id="category-id" name="category-id"
                               value="{{$product->category->id}}" readonly>
                    </div>

                    <div>
                        @php($categories = \App\Repositories\CategoryRepository::getMainCategories())
                        <nav role="navigation">
                            <ul class="category">
                                <li class="subcategory category-li"><a
                                        id="category-name">{{$product->category->name}}</a>
                                    <ul class="category">
                                        @foreach($categories as $category)
                                            @if(count($category->subcategories)>0)
                                                <li class="category-li" id="{{$category->id}}"
                                                    value="{{$category->name}}">{{$category->name}}
                                                    <ul class="category">
                                                        @foreach($category->subcategories as $sub1categories)
                                                            @if(count($sub1categories->subcategories)>0)
                                                                <li class="category-li"
                                                                    id="{{$sub1categories->id}}"
                                                                    value="{{$sub1categories->name}}">{{$sub1categories->name}}
                                                                    <ul class="category">
                                                                        @foreach($sub1categories->subcategories as $sub2categories)
                                                                            @if(count($sub2categories->subcategories)>0)
                                                                                <li class="category-li"
                                                                                    id="{{$sub2categories->id}}"
                                                                                    value="{{$sub2categories->name}}">{{$sub2categories->name}}
                                                                                    <ul class="category">
                                                                                        @foreach($sub2categories->subcategories as $sub3categories)
                                                                                            <li class="category-li"
                                                                                                id="{{$sub3categories->id}}"
                                                                                                value="{{$sub3categories->name}}">
                                                                                                {{$sub3categories->name}}
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </li>
                                                                            @else
                                                                                <li class="category-li"
                                                                                    id="{{$sub2categories->id}}"
                                                                                    value="{{$sub2categories->name}}">{{$sub2categories->name}}</li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <li class="category-li"
                                                                    id="{{$sub1categories->id}}"
                                                                    value="{{$sub1categories->name}}">{{$sub1categories->name}}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="category-li" id="{{$category->id}}"
                                                    value="{{$category->name}}">{{$category->name}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
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
        <x-modal-window id="{{'delete-product-'.$product->id}}">
            <h2>Действительно хотите удалить товар {{$product->name}}</h2>
            <div class="modal-footer">
                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                    Закрыть
                </button>
                <button type="submit" style="margin: 10px" id="DeleteProduct" class="btn btn-primary">Удалить</button>
            </div>
        </x-modal-window>
    </div>
@endsection

@section('page-content')
    <div class="providers" style="border: 1px solid rgba(201, 201, 201, 0.4); border-radius: 15px; padding: 15px;">
        <h3>Наличие на складе</h3>
    </div>

    <script type="text/javascript">
        $('#UpdateProduct').on('submit', function (e) {
            e.preventDefault();
            let name = $("#name").val();
            let category_id = $("#category-id").val();
            $.ajax({
                url: "{{route('products.update', $product->id)}}",
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    category_id: category_id,
                },
                success: function () {
                    location.reload();
                },
                error: function (response) {
                    console.log(response);
                    let obj = JSON.parse(response.responseText);
                    console.log(obj);
                    if (typeof obj.errors !== 'undefined') {
                        let errors_div = $('#updateProductsErrors');
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
        $('#DeleteProduct').on('click', function () {
            $.ajax({
                url: "{{route('products.destroy',  $product->id)}}",
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    location.href = "{{route('products')}}"
                },
                error: function () {
                    alert('There was some error performing the AJAX call!');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(".category-li li").click(function (e) {
            e.stopPropagation();
            $("#category-name").text($(this).attr('value'));
            $("#category-id").val($(this).attr('id'));
        });
    </script>

@endsection
