<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\JoinGameApiRequest;
use App\Http\Requests\LeaveGameRequest;
use App\Http\Requests\ShowGameApiRequest;
use App\Http\Requests\UpdateCharacterApiRequest;
use App\Player;

class ApiController extends Controller {

	/**
	 * Returns a array of all players in a game, including their words, descriptions, links
	 *
	 * @param $game_id
	 * @param $excludePlayerId
	 *
	 */
	private function getGamePlayers(string $game_id, int $excludePlayerId) {
		return Player::where("game_id", $game_id)->where("id", "!=", $excludePlayerId)->get();
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
		if (is_null(Game::find($request->game_id))) return response()->json(["error_message" => trans("error_messages.gameid_not_found")], 404);
		$data = array_merge(["game_id" => $request->game_id], $request->all());
		$player = Player::create($data);
		return response()->json([ "player_id" => $player->id ], 200);
	}

	public function showGame(ShowGameApiRequest $request) {
		if (is_null(Game::find($request->game_id))) return response()->json(["error_message" => trans("error_messages.gameid_not_found")], 404);
		$retPlayers = $this->getGamePlayers($request->game_id, $request->player_id);
		return response()->json(["players" => $retPlayers], 200);
	}

	public function updateCharacter(UpdateCharacterApiRequest $request) {
		$game = Game::find($request->game_id);
		$player = Player::find($request->player_id);
		if ($player->game_id != $game->id) return response()->json(["error_message" => trans("error_messages.wrong_id_combination")], 400);
		$player->update($request->all(["character", "description", "link"]));
		$player->save();
	}

	public function leaveGame(LeaveGameRequest $request) {
		if (Game::find($request->game_id) == null) return response()->json(["error_message" => trans("error_messages.gameid_not_found")], 404);
		$player = Player::find($request->player_id);
		$player->delete();
		if (Player::where("game_id", $request->game_id)->count() == 0) Game::find($request->game_id)->delete(); // Delete game, if nobody is in it anymore
		return response()->json([], 200);
	}

}
