@extends('app')

@section('content')
    <!-- {{ $status or 404 }} -->
    <p>Page not found.</p>
    <button onclick="window.history.back()">Back</button>
@stop
