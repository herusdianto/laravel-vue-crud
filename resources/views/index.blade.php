<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel & VueJS CRUD</title>

    <link rel="stylesheet" href="{{ elixir('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
    <div class="container mrg-2em" id="app">
        <router-view></router-view>
    </div>

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
