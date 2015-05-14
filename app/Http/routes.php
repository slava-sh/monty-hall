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

Route::get('/games',        ['as' => 'games.index',  'uses' => 'GamesController@index']);
Route::post('/games',       ['as' => 'games.create', 'uses' => 'GamesController@create']);
Route::get('/games/{game}', ['as' => 'games.show',   'uses' => 'GamesController@show']);
Route::put('/games/{game}', ['as' => 'games.update', 'uses' => 'GamesController@update']);
