<?php

namespace Tests\Feature;

use App\Game;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JoinGameTest extends TestCase {

	use DatabaseTransactions;

	public function testJoinGameAlone() {
		Game::create([ "id" => "abc" ]);
		$response = $this->json("POST", "/api/joingame/abc", [
			"name" => "aName",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink"
		]);
		$response->assertStatus(200);
		$response->assertExactJson([
			"player_id" => Player::orderBy('created_at', 'desc')->first()->id
		]);
	}

}
