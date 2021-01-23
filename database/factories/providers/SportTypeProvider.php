<?php

namespace Database\Factories\Providers;

use Faker\Provider\Base;

class SportTypeProvider extends Base
{
	/**
	 * Default sports from config/sportr.php.
	 *
	 * @return Illuminate\Support\Collection
	 */
	protected function availableSportTypes()
	{
		return collect(config('sportr.default_sports'));
	}

	/**
	 * Returns a random sport from config.
	 *
	 * @return string
	 */
	public function sport()
	{
		return $this->availableSportTypes()
			->pluck('title')
			->random();
	}
}
