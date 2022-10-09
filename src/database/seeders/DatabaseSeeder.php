<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Licensor;
use App\Models\Studio;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         \App\Models\Anime::factory(100)
             ->has(Studio::factory()->count(mt_rand(0, 4)))
             ->has(Genre::factory()->count(mt_rand(1, 8)))
             ->has(Licensor::factory()->count(mt_rand(0, 10)))
             ->has(Theme::factory()->count(mt_rand(0, 6)))
             ->create();
    }
}
