<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidGameIdRule;
use App\Rules\ValidPlayerIdRule;

class UpdateCharacterApiRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			"game_id" => new ValidGameIdRule(),
			"player_id" => new ValidPlayerIdRule(),
			"character" => "min:1|max:64",
			"description" => "nullable|max:255",
			"link" => "nullable|max:255",
		];
	}
}
