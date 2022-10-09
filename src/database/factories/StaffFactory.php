<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'mal_id'          => mt_rand(1, 99999),
            'name_jp'         => $this->faker->name,
            'name_en'         => $this->faker->name,
            'name_ru'         => $this->faker->name,
            'image_x32'       => '/x32/' . $this->faker->name. '.png',
            'image_x64'       => '/x64/' . $this->faker->name. '.png',
            'image_original'  => '/original/' . $this->faker->lastName . '.png',
            'is_voice_actor'  => $this->faker->boolean,
            'voice_language'  => $this->faker->randomElement(["english", "russian", "french", "japanese"]),
        ];
    }
}
