<?php

namespace Database\Factories\Providers;

use Faker\Provider\Base;

class TeamNameProvider extends Base
{
    /**
     * Creatures for team name generation.
     *
     * @var array
     */
    protected $creatures = [
        'ants', 'bats', 'bears', 'bees', 'birds', 'buffalo', 'cats', 'chickens',
        'cattle', 'dogs', 'dolphins', 'ducks', 'dwarfs', 'elephants', 'fishes', 'foxes',
        'frogs', 'geese', 'goats', 'horses', 'kangaroos', 'lions', 'monkeys',
        'owls', 'oxen', 'penguins', 'people', 'pigs', 'pioneers', 'rabbits', 'sheep', 'tigers',
        'whales', 'wolves', 'zebras', 'banshees', 'crows', 'black cats', 'chimeras',
        'ghosts', 'conspirators', 'dragons', 'dwarfs', 'elves', 'enchanters', 'exorcists',
        'sharks', 'sons', 'foes', 'giants', 'gnomes', 'goblins', 'gooses', 'griffins', 'lycanthropes',
        'nemesis', 'ogres', 'oracles', 'prophets', 'sorcerers', 'spiders', 'spirits', 'vampires',
        'warlocks', 'vixens', 'werewolves', 'witches', 'worshipers', 'zombies', 'druids'
    ];

    /**
     * Returns a random sport from config.
     *
     * @return string
     */
    public function team(): string
    {
        return ucwords($this->generator->state . ' ' . static::randomElement($this->creatures));
    }
}
