@extends('layouts.master')

@section('content')
    {{ $game }}
    <form action="{{ route('games.update', $game) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @for ($door = 1; $door <= 3; ++$door)
            <label><input type="radio" name="door" value="{{ $door }}">{{ $door }}</label>
        @endfor
        <input type="submit" value="Choose">
    </form>
@stop
