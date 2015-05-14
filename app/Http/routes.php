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

Route::get('/games', 'GameController@index');
Route::post('/games', 'GameController@create');
Route::get('/games/{id}', 'GameController@show');
Route::put('/games/{id}', 'GameController@update');
