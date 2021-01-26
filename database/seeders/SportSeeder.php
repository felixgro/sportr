<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Str;

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

        foreach (config('sportr.sports') as $sport) {

            // Seach icon in resources/icons by kebabcasing the sport's title
            $iconPath = resource_path() . '/icons/' . Str::kebab($sport) . '.svg';

            Sport::createWithIcon([
                'title' => $sport,
                'icon' => new File($iconPath)
            ]);
        }

        return true;
    }
}
