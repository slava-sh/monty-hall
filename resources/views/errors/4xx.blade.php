@extends('layouts.master')

@section('title', $message)

@section('content')

    <!-- {{ $status }} -->
    <p>{{ $message }}</p>
    <button onclick="window.history.back()">Back</button>
@stop
