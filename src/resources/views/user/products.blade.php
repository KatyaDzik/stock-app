@extends('layouts.user')

@section('doc-title')
    Продукты
@endsection

@section('page-title')
   <h2>Продукты</h2>
@endsection

@section('page-content')
    <div style="display:flex; justify-content: space-between; margin: 20px 0;">
        <button value="create" class="btn btn-dark btn-open-modal"><a>Добавить</a></button>
    </div>

    <hr/>
    {{--    ВЫВОД ВСЕХ ПОЛЬЗОВАТЕЛЕЙ    --}}
    <table class="table table-striped" style="margin: 0 auto;">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Категория</th>
            <th scope="col">Автор</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($products)>0)
            @foreach($products as $el)
                <tr>
                    <td>{{$el->name}}</td>
                    <td>{{$el->category->name}}</td>
                    <td>{{$el->author->name}}</td>
                    <td>
                        <button class="btn btn-warning show-product"><a href="{{route('products.show', $el->id)}}">Просмотр</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    <div>
        {{$products->links()}}
    </div>

    <x-modal-window id="create">
        <form style="margin: 20px;" id="CreateProduct">
            {{--     Блок для вывода ошибок       --}}
            <div style="display: none" id="createProductsErrors" class="alert alert-danger"></div>
            {{--         Форма       --}}
            @csrf
            <div>
                <div class="form-group">
                    <label for="name">Название</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="category-name">Категория</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="category-name" name="category-name" readonly>
                </div>

                <div class="form-group" style="display: none">
                    <label for="category-id">Категория</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="category-id" name="category-id" readonly>
                </div>

                <nav class="navbar">
                    @php( $categories = \App\Repositories\CategoryRepository::getMainCategories())
                    <ul class="navbar-nav categories">
                        @foreach($categories as $category)
                            @if(count($category->subcategories)>0)
                                <li class="nav-item"><a class="dropdown-toggle" href="#">{{$category->name}}</a>
                                    <ul class="dropdown categories">
                                        @foreach($category->subcategories as $subcategory)
                                            @if(count($subcategory->subcategories)>0)
                                                <li class="nav-item"><a class="dropdown-toggle"
                                                                        id="{{$subcategory->id}}"
                                                                        value="{{$subcategory->name}}"
                                                                        href="#">{{$subcategory->name}}</a>
                                                    <ul class="dropdown categories">
                                                        <li><a href="#">Menu Item</a></li>
                                                        <li><a href="#">Menu</a></li>
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="nav-item" id="{{$subcategory->id}}"
                                                    value="{{$subcategory->name}}">
                                                    <a class="nav-link" href="#">{{$subcategory->name}}</span></a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item" id="{{$category->id}}" value="{{$category->name}}">
                                    <a class="nav-link" href="#">{{$category->name}}</span></a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="modal-footer">
                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                    Закрыть
                </button>
                <button type="submit" style="margin: 10px" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </x-modal-window>
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
            console.log(name);
            console.log(category_id);
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
                    location.reload();
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
@endsection
