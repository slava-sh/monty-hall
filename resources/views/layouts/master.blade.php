<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @if (Route::is('games.index') || Route::is('games.show'))
        <meta property="og:type"        content="website">
        <meta property="og:url"         content="{{ route('games.index') }}">
        <meta property="og:title"       content="Monty Hall Game">
        <meta property="og:description" content="Play the game from the Monty Hall problem. Pick a door, then choose to stay or switch.">
        <meta property="og:image"       content="{{ asset('img/og-image.png') }}?2">
    @endif
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
