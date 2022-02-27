<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->numberBetween(1,6),
            "video_id" => $this->faker->numberBetween(1,3),
            "like" => $this->faker->numberBetween(0,1),
        ];
    }
}
