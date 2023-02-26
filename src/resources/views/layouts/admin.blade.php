<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <title>@yield('doc-title')</title>
</head>
<body>
<main
    style="display: flex; flex-wrap: nowrap; height:  100vh; max-height: 100vh; overflow-x: auto; overflow-y: hidden; background-color: rgba(0, 0, 0, .1);">
    <x-side-bar/>
    <div style="width: 80%; margin: 20px auto; ">
        <div style=" height: 80px; padding: 15px; background: white; border-radius: 10px;"><h2>@yield('page-title')</h2>
        </div>
        <br>
        <div style=" height: 85%; padding: 15px; background: white; border-radius: 10px;">@yield('page-content')</div>
    </div>
    @yield('content')
</main>

<script>
    document.querySelectorAll('.btn-open-modal').forEach(w => {
        w.addEventListener('click', _ => {
            console.log('jnhg');
            console.log(w.value);
            document.getElementById(w.value).style.display = "block";
        })
    })

    document.querySelectorAll('.btn-close-modal').forEach(w => {
        w.addEventListener('click', _ => {
            document.querySelectorAll('.mymodal').forEach(e => {
                e.style.display = "none";
            })
        })
    })
</script>
</body>
</html>
