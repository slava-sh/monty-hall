@extends('layouts.master')

@section('content')
    @if (is_null($game->final_choice))
        <form action="{{ route('games.update', $game) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @for ($door = 1; $door <= 3; ++$door)
                <label><input type="radio" name="door" value="{{ $door }}" {{ $door === $game->revealed_door ? 'disabled' : '' }}>{{ $door }}</label>
            @endfor
            <input type="submit" value="Choose">
        </form>
    @elseif ($game->final_choice === $game->prize_door)
        You win!
    @else
        You lose!
    @endif
    {{ $game }}
@stop
