<?php namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GamesController extends Controller {

    public function index() {
        return view('games.index');
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
        if (!$game->hasInitialChoice()) {
            $game->initial_choice = $request->input('door');
        }
        else if (!$game->hasFinalChoice()) {
            $game->final_choice = $request->input('door');
        }
        else {
            abort(400);
        }
        $game->save();
        return redirect()->route('games.show', $game);
    }
}
