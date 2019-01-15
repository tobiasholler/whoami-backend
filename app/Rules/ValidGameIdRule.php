<?php

namespace App\Rules;

use App\Game;
use Illuminate\Contracts\Validation\Rule;

class ValidGameIdRule implements Rule {
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 * @return bool
	 */
	public function passes($attribute, $value) {
		return !is_null(Game::find($value));
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return trans("error_messages.gameid_not_found");
	}
}
