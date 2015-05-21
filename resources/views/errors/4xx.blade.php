@extends('layouts.master')

@section('title')
    @yield('message', 'Page not found.')
@stop

@section('content')
    <!-- @yield('status') -->
    <p>@yield('title')</p>
    <button onclick="window.history.back()">Back</button>
@stop
