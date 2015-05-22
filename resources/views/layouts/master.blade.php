<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,700,600" rel="stylesheet">
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
</head>
<body id="{{ $page_id }}">
    <div class="container">@yield('content')</div>
    <script src="{{ elixir('js/app.js') }}"></script>
    <script>
        App.init({!! json_encode($route) !!});
    </script>
    @include('widgets.analytics')
</body>
</html>
