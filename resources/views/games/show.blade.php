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
            <div class="door-container">
                <?php $imgs = [ false => '/img/door-closed.svg', true => '/img/door-open.svg' ]; ?>
                @foreach ($doors as $door)
                    <label class="door">
                        <img alt="Door {{ $door->number }}" src="{{ $imgs[$door->is_open] }}">
                        <input type="radio" name="door" value="{{ $door->number }}"
                            {{ $door->number === $game->revealed_door  ? 'disabled' : '' }}
                            {{ $door->number === $game->initial_choice ? 'checked'  : '' }}>
                    </label>
                @endforeach
            </div>
            <button type="submit">Choose</button>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </form>
        <script>
            var form = document.querySelector('form');
            var radios = form.querySelectorAll('input[type="radio"]');
            for (var i = 0, radio; radio = radios[i]; ++i) {
                radio.style.display = 'none';
                if (!radio.disabled) {
                    radio.addEventListener('click', function() {
                        form.submit();
                    });
                    radio.parentNode.style.cursor = 'pointer';
                }
            }
            form.querySelector('button[type="submit"]').style.display = 'none';
        </script>
    @else
        @if ($game->final_choice === $game->prize_door)
            <h1>You win!</h1>
        @else
            <h1>You lose!</h1>
        @endif
        <div class="door-container">
            <?php $imgs = [ false => '/img/door-closed.svg', true => '/img/door-open.svg' ]; ?>
            @foreach ($doors as $door)
                <div class="door">
                    <img alt="Door {{ $door->number }}" src="{{ $imgs[$door->is_open] }}">
                </div>
            @endforeach
        </div>
        <a href="{{ route('games.index') }}">index</a>
    @endif
@stop
