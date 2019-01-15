<?php

namespace Tests\Feature;

use App\Game;
use App\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCharacterTest extends TestCase {

	use DatabaseTransactions;

	public function testUpdateCharacter() {
		Game::create([
			"id" => "aGameId"
		]);
		$me = Player::create([
			"game_id" => "aGameId",
			"name" => "aName",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink",
		]);
		$response = $this->json("PUT", "/api/updatecharacter", [
			"game_id" => "aGameId",
			"player_id" => $me->id,
			"character" => "bCharacter",
			"description" => "bDescription",
			"link" => "bLink",
		]);
		$response->assertStatus(200);
		$meAfterChange = Player::find($me->id);
		$this->assertEquals("bCharacter", $meAfterChange->character);
		$this->assertEquals("bDescription", $meAfterChange->description);
		$this->assertEquals("bLink", $meAfterChange->link);
	}

	public function testUpdateCharacterPartly() {
		Game::create([
			"id" => "aGameId"
		]);
		$me = Player::create([
			"game_id" => "aGameId",
			"name" => "aName",
			"character" => "aCharacter",
			"description" => "aDescription",
			"link" => "aLink",
		]);
		$response = $this->json("PUT", "/api/updatecharacter", [
			"game_id" => "aGameId",
			"player_id" => $me->id,
			"character" => "bCharacter",
		]);
		echo $response->getContent();
		$response->assertStatus(200);
		$meAfterChange = Player::find($me->id);
		$this->assertEquals("bCharacter", $meAfterChange->character);
		$this->assertEquals("", $meAfterChange->description);
		$this->assertEquals("", $meAfterChange->link);
	}

}
