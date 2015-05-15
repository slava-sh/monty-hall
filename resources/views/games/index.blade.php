@extends('layouts.master')

@section('content')
    <form action="{{ route('games.create') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="New Game">
    </form>
    <hr>
    <pre>
{{ $played_game_count }} games played
{{ sprintf('%5.2f', $win_percent)             }}% won
{{ sprintf('%5.2f', $stay_percent)            }}% stayed
{{ sprintf('%5.2f', $switch_percent)          }}% switched
{{ sprintf('%5.2f', $win_percent_of_stayed)   }}% of those who stayed won
{{ sprintf('%5.2f', $win_percent_of_switched) }}% of those who switched won
    </pre>
    <hr>
@stop
