@extends('layouts.game')

@section('title', 'Monty Hall Game')

@section('game.buttons')
    @include('games.new-game-button', ['title' => 'Play'])
    @if ($user_has_played_a_game)
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/') }}">Share</a>
    @endif
@stop

@section('game.body')
    @if ($user_has_played_a_game)
      <div class="statistics">
          <table>
              <tr><td><strong>Stayers  </td><td>win in <strong>{{ sprintf('%.0f', $stay_win_rate)   }}%</strong> of cases.</td></tr>
              <tr><td><strong>Switchers</td><td>win in <strong>{{ sprintf('%.0f', $switch_win_rate) }}%</strong> of cases.</td></tr>
          </table>
          <p><strong>{{ sprintf('%.0f', $switch_rate) }}%</strong> of players switch.</p>
          <p>Based on <strong>{{ $played_game_count }}</strong> games.</p>
      </div>
    @endif
@stop
