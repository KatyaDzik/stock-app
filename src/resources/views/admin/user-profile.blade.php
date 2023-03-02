@extends('layouts.admin')

@section('doc-title')
    Админ панель
@endsection

@section('page-title')
    {{$user->name}}
@endsection

@section('page-content')
    <div style="margin: 30px">
        <h3>Настройка разрешений</h3>
        @php( $permissions = \App\Models\Permission::all())
        @foreach($permissions as $permission)
            <div class="form-check form-switch">
                {{--                checked or disabled--}}
                <input class="form-check-input" name="permissions" id="{{$permission->id}}" type="checkbox"
                       value="{{$permission->id}}" {{$user->permissions->containsStrict('id', $permission->id) ? 'checked' : ''}}>
                <label class="form-check-label" for="{{$permission->id}}">{{$permission->description}}</label>
            </div>
        @endforeach
        <button style="margin-top:10px" type="button" class="btn btn-success btn-open-modal"
                value="checkPermissionsChanges">Сохранить
        </button>


        <x-modal-window id="checkPermissionsChanges">
            <h2>Сохранить разрешения для пользователя {{$user->name}}</h2>
            <div class="modal-footer">
                <button type="button" style="margin: 10px" class="btn btn-secondary btn-close-modal">
                    Закрыть
                </button>
                <button style="margin: 10px" id="SavePermissions" class="btn btn-primary">Сохранить</button>
            </div>
        </x-modal-window>
    </div>

    <script type="text/javascript">
        $('#SavePermissions').on('click', function (e) {
            let permissions = [];
            $('input:checkbox[name=permissions]').each(function () {
                if ($(this).is(':checked'))
                    permissions.push($(this).val());
            });

            $.ajax({
                url: "{{route('admin-update-user-permissions', $user->id)}}",
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "permissions": permissions
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function (response) {
                    console.log(response);
                },
            });
        });
    </script>
@endsection
