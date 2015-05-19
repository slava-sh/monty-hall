@extends('app')

@section('content')
    <pre>
{{ $played_game_count }} games played
{{ sprintf('%5.2f', $win_percent)             }}% won
{{ sprintf('%5.2f', $stay_percent)            }}% stayed
{{ sprintf('%5.2f', $switch_percent)          }}% switched
{{ sprintf('%5.2f', $win_percent_of_stayed)   }}% of those who stayed won
{{ sprintf('%5.2f', $win_percent_of_switched) }}% of those who switched won
    </pre>
    @include('games.new-game-button', ['title' => 'Play'])
@stop
