@extends('app')

@if (is_null($game->final_choice))
    @if (is_null($game->initial_choice))
        @section('title', 'Choose a door')
    @else
        @section('title', 'Stay or switch?')
    @endif
@else
    @if ($game->final_choice === $game->prize_door)
        @section('title', 'You win!')
    @else
        @section('title', 'You lose!')
    @endif
@endif

@section('content')
    @if (is_null($game->final_choice))
        @if (is_null($game->initial_choice))
            <h1>Let's Make a Deal</h1>
            <p>There are three doors. Only one of them is the winning door. Choose a door.</p>
        @else
            <h1>You Picked the {{ ['', 'First', 'Second', 'Third'][$game->initial_choice] }} Door</h1>
            <p>I opened one losing door for you. Now you can either stay with your choice or switch.</p>
        @endif
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
        <h1>@yield('title')</h1>
        @include('games.new-game-button', ['title' => 'Play Again'])
        <a href="{{ route('games.index') }}">Home</a>
        <div class="door-container">
            @foreach ($doors as $door)
                <div class="door">
                    <img alt="Door {{ $door->number }} ({{ $door->state }})" src="{{ $door->image }}">
                </div>
            @endforeach
        </div>
    @endif
@stop
