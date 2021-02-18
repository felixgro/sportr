<?php

namespace Database\Factories;

use App\Models\{Event, Report, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->word,
            'description' => $this->faker->text(150),
            'event_id' => Event::factory(),
            'user_id' => User::factory()
        ];
    }
}
