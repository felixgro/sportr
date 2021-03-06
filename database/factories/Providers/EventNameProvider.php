<?php

namespace Database\Factories\Providers;

use Faker\Provider\Base;

class EventNameProvider extends Base
{
    /**
     * Event places for random prefix.
     *
     * @var array
     */
    protected $places = [
        'world', 'european', 'american', 'asian'
    ];

    /**
     * Event nouns for random suffix.
     *
     * @var array
     */
    protected $nouns = [
        'cup', 'championship', 'tournament', 'battle', 'finals', 'olympics',
    ];

    /**
     * Returns a random event place.
     *
     * @return string
     */
    public function eventPlace()
    {
        return ucwords(static::randomElement($this->places));
    }

    /**
     * Returns a random event noun.
     *
     * @return string
     */
    public function eventNoun()
    {
        return ucwords(static::randomElement($this->nouns));
    }
}
