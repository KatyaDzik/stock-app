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
    {{--    ВЫВОД ВСЕХ ТОВАРОВ    --}}
    <table class="table table-striped" style="margin: 0 auto;">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Поставщик</th>
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
                    <td>{{$el->provider->name}}</td>
                    <td>{{$el->category->name}}</td>
                    <td>{{$el->author->name}}</td>
                    <td>
                        <button class="btn btn-warning show-product"><a href="{{route('products.show', $el->id)}}">Просмотр</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    <div>
        {{$products->links()}}
    </div>
    {{--    ДОБАВЛЕНИЕ ТОВАРА    --}}
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

                <div>
                    <div class="wrapper" style="width: auto; margin: 15px 0 40px 0">
                        <div class="select-btn" style="padding: 0 10px">
                            <label for="provider-name" style="color: black">Поставщик</label><span
                                class="required-field"> *</span>
                            <input type="text" id="provider-name" class="form-control select-item">
                            <i class="uil uil-angle-down"></i>
                        </div>
                        <div class="content">
                            <div class="search">
                                <i class="uil uil-search"></i>
                                <input spellcheck="false" type="text" placeholder="Search">
                            </div>
                            <ul class="options" style="position: static"></ul>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="display: none">
                    <label for="category-id">Категория</label><span class="required-field"> *</span>
                    <input type="text" class="form-control" id="category-id" name="category-id" readonly>
                </div>

                <div>
                    @php($categories = \App\Repositories\CategoryRepository::getMainCategories())
                    <nav role="navigation">
                        <ul class="category">
                            <li class="subcategory category-li"><a id="category-name">Категория</a>
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

    <script type="text/javascript">
        $('#CreateProduct').on('submit', function (e) {
            e.preventDefault();
            let name = $("#name").val();
            let category_id = $("#category-id").val();
            let provider = $("#provider-name").val();
            $.ajax({
                url: "{{route('products.store')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    category_id: category_id,
                    provider: provider
                },
                success: function (response) {
                    location.reload();
                },
                error: function (response) {
                    console.log(response);
                    let obj = JSON.parse(response.responseText);
                    console.log(obj);
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

    <script type="text/javascript">
        const wrapper = document.querySelector(".wrapper"),
            selectBtn = wrapper.querySelector(".select-btn"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");
        const selectSpan = document.querySelector('.select-item');
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
            options.innerHTML = "";
            providers.forEach(function (value) {
                let isSelected = value == selectedProduct ? "selected" : "";
                let li = `<li onclick="updateName(this)" value="${value['key']}" class="${isSelected}">${value['name']}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }

        function start() {
            providers = fillDataSelect();
            addDataToList();
        }

        start();

        function updateName(selectedLi) {
            searchInp.value = "";
            addDataToList(selectedLi.innerText);
            wrapper.classList.remove("active");
            $("#provider-name").val(selectedLi.innerText);
            let result = providers.filter(obj => {
                return obj.key == selectedLi.value
            })
        }

        searchInp.addEventListener("keyup", () => {
            let arr = [];
            let searchWord = searchInp.value.toLowerCase();
            arr = providers.filter(data => {
                return data["name"].toLowerCase().startsWith(searchWord);
            }).map(data => {
                let isSelected = data["name"] == selectBtn.firstElementChild.innerText ? "selected" : "";
                return `<li onclick="updateName(this)" value="${data['key']}" class="${isSelected}">${data["name"]}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">продукт не найден</p>`;
        });
        selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"))
    </script>

    <script type="text/javascript">
        $(".category-li li").click(function (e) {
            e.stopPropagation();
            $("#category-name").text($(this).attr('value'));
            $("#category-id").val($(this).attr('id'));
        });
    </script>
@endsection
