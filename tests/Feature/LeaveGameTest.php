<?php

namespace Tests\Feature;

use App\Game;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeaveGameTest extends TestCase {

	use DatabaseTransactions;

	public function testLeaveGameAlone() {
		Game::create([
			"id" => "abc"
		]);
		$me = Player::create([
			"game_id" => "abc",
			"name" => "aPlayer",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink"
		]);
		$response = $this->json("DELETE", "/api/leavegame/abc", [ "player_id" => $me->id ]);
		$response->assertStatus(200);
		$this->assertNull(Game::find("abc"));
	}
	public function testLeaveGameNotEmptyAfter() {
		Game::create([
			"id" => "abc"
		]);
		$me = Player::create([
			"game_id" => "abc",
			"name" => "aPlayer",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink"
		]);
		Player::create([
			"game_id" => "abc",
			"name" => "bPlayer",
			"character" => "bCharacter",
			"description" => "bDescription",
			"link" => "bLink"
		]);
		$response = $this->json("DELETE", "/api/leavegame/abc", [ "player_id" => $me->id ]);
		$response->assertStatus(200);
		$this->assertNotNull(Game::find("abc"));
	}
}
