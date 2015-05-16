<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div style="width: 600px; margin: 50px auto;">
        @yield('content')
    </div>

    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
