<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return bool
     */
    public function run(): bool
    {
        if (Sport::all()->count() > 0) {
            return false;
        }

        foreach (config('sportr.default_sports') as $sport) {
            Sport::create([
                'title' => $sport['title']
            ]);
        }

        return true;
    }
}
