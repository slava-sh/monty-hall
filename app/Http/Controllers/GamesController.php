<?php namespace App\Http\Controllers;

use Session;
use App\Models\Game;
use App\Http\Requests\ChooseDoorRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GamesController extends Controller {

    public function index() {
        $played_game_count      = Game::finished()->count();
        $switch_rate            = static::percent(Game::wins()            ->count(), $played_game_count);
        $stay_win_rate          = static::percent(Game::stayed()  ->wins()->count(), Game::stayed()  ->count());
        $switch_win_rate        = static::percent(Game::switched()->wins()->count(), Game::switched()->count());
        $user_has_played_a_game = Session::get('user_has_played_a_game', false);
        return view('games.index')->with(compact([
            'played_game_count',
            'switch_rate',
            'stay_win_rate',
            'switch_win_rate',
            'user_has_played_a_game',
        ]));
    }

    protected static function percent($a, $b) {
        if ($b === 0) {
            return 0;
        }
        return $a / $b * 100;
    }

    public function create() {
        $game = Game::create([]);
        return redirect()->route('games.show', $game);
    }

    public function show($game) {
        $doors = [];
        for ($i = 1; $i <= 3; ++$i) {
            if ($i === $game->final_choice) {
                $door_state = $game->final_choice === $game->prize_door ? 'win' : 'lose';
            }
            else if ($i === $game->revealed_door) {
                $door_state = 'lose';
            }
            else {
                $door_state = 'closed';
            }
            $doors[] = (object) [
                'number' => $i,
                'state'  => $door_state,
                'image'  => asset('img/door-' . $door_state . '.svg'),
            ];
        }
        return view('games.show')->with(compact('game', 'doors'));
    }

    public function update($game, ChooseDoorRequest $request) {
        $game->choose($request->door);
        $game->save();
        if (!is_null($game->final_choice)) {
            Session::set('user_has_played_a_game', true);
        }
        return redirect()->route('games.show', $game);
    }
}
