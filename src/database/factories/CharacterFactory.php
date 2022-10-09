<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class CharacterFactory extends Factory
{
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mal_id'          => mt_rand(1, 99999),
            'name_jp'         => $this->faker->lastName,
            'name_en'         => $this->faker->lastName,
            'name_ru'         => $this->faker->lastName,
            'image_x32'       => '/x32/' . $this->faker->name. '.png',
            'image_x64'       => '/x64/' . $this->faker->name. '.png',
            'image_original'  => '/original/' . $this->faker->lastName . '.png',
        ];
    }
}
