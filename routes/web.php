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

Route::post("/api/newgame", "ApiController@newGame");
Route::post("/api/joingame/{game_id}", "ApiController@joinGame");
Route::get("/api/showgame/{game_id}", "ApiController@showGame");
Route::update("/api/updatecharacter", "ApiController@updateCharacter");
Route::delete("/api/leavegame", "ApiController@leaveGame");