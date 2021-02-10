<?php

namespace Database\Factories;

use App\Models\Sport;
use App\Models\Team;
use Database\Factories\Providers\TeamNameProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Add custom faker provider for team names.
     *
     * @return void
     */
    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $this->faker->addProvider(new TeamNameProvider($this->faker));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique(true)->team,
            'sport_id' => Sport::all()->random()->id
        ];
    }
}
