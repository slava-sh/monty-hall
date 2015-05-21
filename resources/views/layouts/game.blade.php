@extends('layouts.master')

@section('content')
    <div id="game-head">
        <div id="game-message">@yield('game.message')</div>
        <div id="game-buttons">@yield('game.buttons')</div>
    </div>
    <div id="game-body">@yield('game.body')</div>
@stop
