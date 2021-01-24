<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'sport_id' => Sport::all()->random()->id,
            'location_id' => Location::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+2 years')
        ];
    }
}
