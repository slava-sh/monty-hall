<?php namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GamesController extends Controller {

    public function index() {
        $played_game_count       = Game::finished()->count();
        $win_percent             = Game::stayed()          ->count() / $played_game_count        * 100;
        $stay_percent            = Game::switched()        ->count() / $played_game_count        * 100;
        $switch_percent          = Game::wins()            ->count() / $played_game_count        * 100;
        $win_percent_of_stayed   = Game::stayed()  ->wins()->count() / Game::stayed()  ->count() * 100;
        $win_percent_of_switched = Game::switched()->wins()->count() / Game::switched()->count() * 100;
        return view('games.index')->with(compact([
            'played_game_count',
            'win_percent',
            'stay_percent',
            'switch_percent',
            'win_percent_of_stayed',
            'win_percent_of_switched',
        ]));
    }

    public function create() {
        $game = Game::create([]);
        return redirect()->route('games.show', $game);
    }

    public function show($game) {
        $doors = [];
        for ($i = 1; $i <= 3; ++$i) {
            $doors[] = (object) [
                'number'  => $i,
                'is_open' => $i === $game->revealed_door ||
                             $i === $game->final_choice,
            ];
        }
        return view('games.show')->with(compact('game', 'doors'));
    }

    public function update($game, Request $request) {
        $pickable_doors = collect(range(1, 3))->filter(function($door) use ($game) {
            return $door !== $game->revealed_door;
        });
        $this->validate($request, [
            'door' => 'required|in:' . $pickable_doors->implode(','),
        ]);
        $game->choose($request->input('door'));
        $game->save();
        return redirect()->route('games.show', $game);
    }
}
