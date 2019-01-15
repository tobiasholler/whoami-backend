<?php

namespace Tests\Feature;

use App\Player;
use App\Game;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowGameTest extends TestCase {

	use DatabaseTransactions;

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testShowGame() {
		Game::create(["id" => "abc"]);
		$me = Player::create([
			"game_id" => "abc",
			"name" => "aName",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink"
		]);
		$playerB = Player::create([
			"game_id" => "abc",
			"name" => "bName",
			"character" => "bCharacter",
			"description" => "bDescription",
			"link" => "bLink"
		]);
		$playerC = Player::create([
			"game_id" => "abc",
			"name" => "cName",
			"character" => "cCharacter",
			"description" => "cDescription",
			"link" => "cLink"
		]);
		$response = $this->json("GET", "/api/showgame/abc", [ "player_id" => $me->id ]);
		$response->assertExactJson([
			"players" => [
				[
					"name" => "bName",
					"character" => "bCharacter",
					"description" => "bDescription",
					"link" => "bLink"
				],
				[
					"name" => "cName",
					"character" => "cCharacter",
					"description" => "cDescription",
					"link" => "cLink"
				]
			]
		]);
	}
}
