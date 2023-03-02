<?php

{{--            <div class="form-group select-category">--}}
{{--                <label for="role">Категория</label><span class="required-field"> *</span>--}}
{{--                @php( $categories = \App\Repositories\CategoryRepository::getMainCategories())--}}
{{--                <select class="form-select categories" id="categories" aria-label="Default select example">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

<script type="text/javascript">
    {{--$(".categories").change(function () {--}}
    {{--    let category_id = $("#categories option:selected").val();--}}
    {{--    let category_name = $("#categories option:selected").text();--}}
    {{--    console.log(category_name);--}}
    {{--    let arr = [--}}
    {{--        {val: 1, text: 'One'},--}}
    {{--        {val: 2, text: 'Two'},--}}
    {{--        {val: 3, text: 'Three'}--}}
    {{--    ];--}}

    {{--    var sel = $('<select class="form-select categories" id="categories">').appendTo('div.select-category');--}}
    {{--    $(arr).each(function () {--}}
    {{--        sel.append($("<option>").attr('value', this.val).text(this.text));--}}
    {{--    });--}}
    {{--    @php--}}


    {{--    @endphp--}}
    {{--});--}}

    $('#CreateProduct').on('submit', function (e) {
        e.preventDefault();
        // let name = $('#name').val();
        // let category_id = $("#categories option:selected").val();
        // console.log(category_id);
        {{--$.ajax({--}}
        {{--    url: "{{route('admin-create-user')}}",--}}
        {{--    type: "POST",--}}
        {{--    data: {--}}
        {{--        "_token": "{{ csrf_token() }}",--}}
        {{--        name: name,--}}
        {{--        login: login,--}}
        {{--        role_id: role_id,--}}
        {{--        password: password,--}}
        {{--        password_confirmed: password_confirmed--}}
        {{--    },--}}
        {{--    success: function (response) {--}}
        {{--        console.log(response);--}}
        {{--        location.reload();--}}
        {{--    },--}}
        {{--    error: function (response) {--}}
        {{--        let obj = JSON.parse(response.responseText);--}}
        {{--        if (typeof obj.errors !== 'undefined') {--}}
        {{--            let errors_div = $('#createUserErrors');--}}
        {{--            errors_div.empty();--}}
        {{--            for (key in obj.errors) {--}}
        {{--                obj.errors[key].forEach(function (elem) {--}}
        {{--                    let p = document.createElement('p');--}}
        {{--                    p.innerHTML = elem;--}}
        {{--                    errors_div.append(p)--}}
        {{--                    console.log(elem);--}}
        {{--                });--}}
        {{--            }--}}
        {{--            errors_div[0].style.display = "block";--}}
        {{--        }--}}
        {{--    },--}}
        {{--});--}}
    });
</script>
