@extends('layouts.master')

@section('content')
    <form action="{{ route('games.create') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="New Game">
    </form>
    <hr>
    ** list of games **
@stop
