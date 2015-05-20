<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get ('/',         ['as' => 'games.index',  'uses' => 'GamesController@index']);
post('/g',        ['as' => 'games.create', 'uses' => 'GamesController@create']);
get ('/g/{game}', ['as' => 'games.show',   'uses' => 'GamesController@show']);
put ('/g/{game}', ['as' => 'games.update', 'uses' => 'GamesController@update']);
