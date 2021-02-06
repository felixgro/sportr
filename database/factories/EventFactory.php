<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Location;
use App\Models\Sport;
use Database\Factories\Providers\EventNameProvider;
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
     * Add custom faker provider for event titles.
     *
     * @return void
     */
    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $this->faker->addProvider(new EventNameProvider($this->faker));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sport = Sport::all()->random();

        return [
            'title' => "{$this->faker->eventPlace} {$sport->title} {$this->faker->eventNoun}",
            'sport_id' => $sport->id,
            'location_id' => Location::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+2 years')
        ];
    }
}
