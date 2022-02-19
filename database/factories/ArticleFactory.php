<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $user_id = 1;

        if ($user_id > 10) {
            $user_id = 1;
        }

        return [
            'user_id' => $user_id++,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->text(200),
        ];
    }
}
