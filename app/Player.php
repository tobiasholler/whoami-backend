<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {
	protected $fillable = [
		"game_id", "name", "character", "description", "link"
	];
	protected $hidden = [ "id", "game_id", "created_at", "updated_at" ];
}
