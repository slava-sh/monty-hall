@extends('app')

@section('content')
    @if (is_null($game->final_choice))
        @if (is_null($game->initial_choice))
            <h1>Let's Make a Deal</h1>
            <p>There are three doors. Only one of them is the winning door. Choose a door.</p>
        @else
            <h1>You Picked the {{ ['', 'First', 'Second', 'Third'][$game->initial_choice] }} Door</h1>
            <p>I opened one losing door for you. Now you can either stay with your choice or switch.</p>
        @endif
        <form action="{{ route('games.update', $game) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @for ($door = 1; $door <= 3; ++$door)
                <label>
                    <input type="radio" name="door" value="{{ $door }}"
                        {{ $door === $game->revealed_door  ? 'disabled' : '' }}
                        {{ $door === $game->initial_choice ? 'checked'  : '' }}>
                    {{ $door }}
                </label>
            @endfor
            <input type="submit" value="Choose">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </form>
    @elseif ($game->final_choice === $game->prize_door)
        <h1>You win!</h1>
    @else
        <h1>You lose!</h1>
    @endif
@stop
