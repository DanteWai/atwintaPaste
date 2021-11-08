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
            'content' => $this->faker->text(100),
            'user_id' => $this->faker->numberBetween(1, 20),
            'access_id' => $this->faker->numberBetween(1, 3),
            'lang_id' => $this->faker->randomElement([1,2,3,4, null]),
        ];
    }
}
