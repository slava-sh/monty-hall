<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GamesController extends Controller {

    public function index() {
        return view('games.index');
    }

    public function create() {
        return redirect()->route('games.show', [1]);
    }

    public function show($id) {
        return view('games.show')->with('id', $id);
    }

    public function update($id) {
        return redirect()->route('games.show', [1]);
    }
}
