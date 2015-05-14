@extends('layouts.master')

@section('content')
    <form action="/games" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="new game">
    </form>
    <hr>
    ** list of games **
@stop
