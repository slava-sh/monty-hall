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
        return view('games.index')->with([
            'played_game_count'       => $played_game_count,
            'win_percent'             => $win_percent,
            'stay_percent'            => $stay_percent,
            'switch_percent'          => $switch_percent,
            'win_percent_of_stayed'   => $win_percent_of_stayed,
            'win_percent_of_switched' => $win_percent_of_switched,
        ]);
    }

    public function create() {
        $game = Game::create([]);
        return redirect()->route('games.show', $game);
    }

    public function show($game) {
        return view('games.show')->withGame($game);
    }

    public function update($game, Request $request) {
        if (!$request->has('door')) {
            abort(400);
        }
        if (!$game->choose($request->input('door'))) {
            abort(400);
        }
        $game->save();
        return redirect()->route('games.show', $game);
    }
}
