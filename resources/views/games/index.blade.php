@extends('layouts.game')

@section('title', 'Monty Hall Game')

@section('game.buttons')
    @include('games.new-game-button', ['title' => 'Play'])
@stop

@section('game.body')
    <div class="statistics">
        <p><strong>{{ $played_game_count }}</strong> games played.</p>
        <p><strong>{{ sprintf('%.0f', $switch_rate) }}%</strong> of players switched.</p>
        <table>
            <tr><td><strong>Stayers</strong></td>  <td>win in <strong>{{ sprintf('%.0f', $stay_win_rate)   }}%</strong> of cases.</td></tr>
            <tr><td><strong>Switchers</strong></td><td>win in <strong>{{ sprintf('%.0f', $switch_win_rate) }}%</strong> of cases.</td></tr>
        </table>
    </div>
@stop
