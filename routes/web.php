<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get ('/',         ['as' => 'games.index',  'uses' => 'GamesController@index']);
Route::post('/g',        ['as' => 'games.create', 'uses' => 'GamesController@create']);
Route::get ('/g/{game}', ['as' => 'games.show',   'uses' => 'GamesController@show']);
Route::put ('/g/{game}', ['as' => 'games.update', 'uses' => 'GamesController@update']);
