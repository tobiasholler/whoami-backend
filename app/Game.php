<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {
	protected $fillable = [ "id" ];
	protected $hidden = [ "created_at", "updated_at" ];
}
