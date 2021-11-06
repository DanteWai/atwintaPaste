<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->bothify('?#?#?#?#'),
            'access' => $this->faker->randomElement(['public', 'unlisted', 'private']),
            'language' => $this->faker->randomElement(['c++', 'js', 'php', null]),
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
