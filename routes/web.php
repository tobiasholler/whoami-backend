<?php

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

Route::prefix("api")->group(function () {
	Route::post("newgame", "ApiController@newGame");
	Route::post("joingame/{game_id}", "ApiController@joinGame");
	Route::get("showgame/{game_id}", "ApiController@showGame");
	Route::put("updatecharacter", "ApiController@updateCharacter");
	Route::delete("leavegame/{game_id}", "ApiController@leaveGame");
});
