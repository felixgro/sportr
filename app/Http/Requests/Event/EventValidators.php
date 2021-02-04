<?php

namespace App\Http\Requests\Event;

use App\Models\Location;

trait EventValidators
{
	/**
	 * Validates an event's location.
	 *
	 * @param  string $attr
	 * @param  mixed $val
	 * @param  callable $fail
	 * @return void
	 */
	protected function validateLocation($attr, $val, $fail)
	{
		if (!is_int($val) && !is_array($val)) {
			$fail("The {$attr} needs to be of type array or integer.");
		}

		if (is_int($val) && !Location::find($val)) {
			$fail("Cant find Location with id {$val}");
		}
	}

	/**
	 * Validates all of the event's teams.
	 *
	 * @param  string $attr
	 * @param  mixed $val
	 * @param  callable $fail
	 * @return void
	 */
	protected function validateTeams($attr, $val, $fail)
	{
		if ((!array_key_exists('team', $val) && !array_key_exists('id', $val)) || !array_key_exists('score', $val)) {
			$fail("Each Team needs either an id or team key along with an score");
		}
	}
}
