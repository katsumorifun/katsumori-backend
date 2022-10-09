<?php

namespace Database\Factories;

use App\Models\Anime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    protected $model = Anime::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mal_id'          => mt_rand(1, 9999999),
            'mal_score'       => mt_rand(1, 10),
            'title_jp'        => $this->faker->name,
            'title_en'        => $this->faker->name,
            'title_ru'        => $this->faker->name,
            'synopsis_en'     => $this->faker->text,
            'synopsis_ru'     => $this->faker->text,
            'type'            => $this->faker->randomElement(['serial',  'film', 'ova', 'ona', 'clip', 'special', 'tv']),
            'approved'        => mt_rand(0, 1),
            'status'          => $this->faker->randomElement(['announced', 'ongoing', 'finished']),
            'image_x32'       => '/x32/' . $this->faker->name. '.png',
            'image_x64'       => '/x64/' . $this->faker->name. '.png',
            'image_x128'      => '/x128/' . $this->faker->name. '.png',
            'image_original'  => '/original/' . $this->faker->lastName . '.png',
            'title_synonyms'  => [
                [
                    "type"  => $this->faker->randomElement(['japanese',  'english', 'russian']),
                    "title" => "title",
                ]
            ],
            'source'          => $this->faker->randomElement(['manga', 'light novel', 'original']),
            'episodes'        => mt_rand(1, 2000),
            'episodes_aired'  => mt_rand(1, 400),
            'episodes_to'     => $this->faker->dateTime,
            'episodes_from'   => $this->faker->dateTime,
            'duration'        => mt_rand(8, 60*3),
            'age_rating'      => $this->faker->randomElement(['g', 'pg', 'pg-13', 'r-17', 'r+']),
            'season'          => $this->faker->randomElement(['summer', 'autumn', 'winter', 'spring']),
        ];
    }
}
