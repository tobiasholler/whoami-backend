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
		$jsonResponse = json_decode($response->getContent());
		$this->assertNotEquals(null, Game::find($jsonResponse->game_id));
	}

}
