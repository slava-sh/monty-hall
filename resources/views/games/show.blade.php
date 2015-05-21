@extends('layouts.game')

@section('title')
    @if (is_null($game->final_choice) && is_null($game->initial_choice))
        Choose a door
    @elseif (is_null($game->final_choice))
        Stay or switch?
    @else
        @if ($game->final_choice === $game->prize_door)
            You win!
        @else
            You lose!
        @endif
    @endif
@stop

@section('game.message')
    @if (is_null($game->final_choice) && is_null($game->initial_choice))
        <p>There are three doors.</p>
        <p>Only one of them is the winning door.</p>
        <p>Choose a door.</p>
    @elseif (is_null($game->final_choice))
        <p>I opened one losing door for you.</p>
        <p>Now you can either stay with your choice or switch.</p>
    @else
        <h1>@yield('title')</h1>
    @endif
@stop

@section('game.buttons')
    @if (is_null($game->final_choice) && is_null($game->initial_choice))
    @elseif (is_null($game->final_choice))
        <a href="{{ route('games.index') }}">Stay</a>
        <a href="{{ route('games.index') }}">Switch</a>
    @else
        @include('games.new-game-button', ['title' => 'Play Again'])
        <a href="{{ route('games.index') }}">Play Again</a>
    @endif
@stop

@section('game.body')
    @if (is_null($game->final_choice))
        <form id="game" action="{{ route('games.update', $game) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="door-container">
                @foreach ($doors as $door)
                    <label class="door">
                        <img alt="Door {{ $door->number }} ({{ $door->state }})" src="{{ $door->image }}">
                        <input type="radio" name="door" value="{{ $door->number }}"
                            {{ $door->number === $game->revealed_door  ? 'disabled' : '' }}
                            {{ $door->number === $game->initial_choice ? 'checked'  : '' }}>
                    </label>
                @endforeach
            </div>
            <input type="submit" value="Choose">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </form>
    @else
        <div class="door-container">
            @foreach ($doors as $door)
                <div class="door">
                    <img alt="Door {{ $door->number }} ({{ $door->state }})" src="{{ $door->image }}">
                </div>
            @endforeach
        </div>
    @endif
@stop
