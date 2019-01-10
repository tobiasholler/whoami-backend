<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinGameApiRequest;
use App\Player;
use Illuminate\Http\Request;

class ApiController extends Controller {

	/**
	 * Returns a array of all players in a game, including their words, descriptions, links
	 *
	 * @param $group_id
	 *
	 */
	private function getGamePlayers(int $group_id, int $excludePlayerId) {
		return Player::where("group_id", $group_id)->where("id", "!=", );
	}

	public function newGame() {
		do {
			$str = str_random(16);
		} while (Game::find($str));
		Game::create([
			"id" => $str
		]);
		return response()->json(["game_id" => $str]);
	}

	public function joinGame(JoinGameApiRequest $request) {
		if (Game::find($request->game_id) == null) return response()->json(["error_message" => trans("error_messages.gameid_not_found")], 400);
		Player::create($request);

	}

}
