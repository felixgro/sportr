<?php

namespace Database\Factories;

use App\Models\Sport;
use Database\Factories\Providers\SportTypeProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sport::class;

    /**
     * Add custom faker provider for sports.
     *
     * @return void
     */
    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $this->faker->addProvider(new SportTypeProvider($this->faker));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sport
        ];
    }
}
