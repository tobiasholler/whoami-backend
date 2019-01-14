<?php

namespace Tests\Feature;

use App\Game;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateGameTest extends TestCase {
	/**
	 * A basic test example.
	 *
	 * @return void
	 */

	use DatabaseTransactions;

	public function testCreateGame() {
		$response = $this->json("POST", "/api/newgame", []);
		$response->assertStatus(200);
		$response->assertJsonStructure([
			"game_id"
		]);
	}

	public function testJoinGameAlone() {
		Game::create([
			"id" => "abc"
		]);
		$response = $this->json("POST", "/api/join/abc", [
			"name" => "aName", "character" => "aCharacter", "description" => "aDescription", "link" => "aLink"
		]);
		$response->assertStatus(200);
		$response->assertExactJson([
			"players" => []
		]);
	}

	public function testJoinGameWithPersonAlreadyInIt() {
		Game::create([
			"id" => "abc"
		]);
		Player::create([
			"game_id" => "abc",
			"name" => "aName",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink"
		]);
		$response = $this->json("POST", "/api/join/abc", [
			"name" => "bName", "character" => "bCharacter", "description" => "bDescription", "link" => "bLink"
		]);
		$response->assertStatus(200);
		$response->assertExactJson([
			"players" => [
				[
					"name" => "aName",
					"character" => "aCharacter",
					"description" => "aDescription",
					"link" => "aLink"
				]
			]
		]);
	}

}
