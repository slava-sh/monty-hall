<form action="{{ route('games.create') }}" method="POST" class="new-game">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="{{ $title }}">
</form>
