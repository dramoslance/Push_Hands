<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            "banner" => $this->faker->imageUrl(),
            "slug" => $this->faker->slug(),
            "start_time" => $this->faker->dateTime(),
            "end_time" => $this->faker->dateTime(),
            "highlighted" => $this->faker->boolean(),
            "timezone" => $this->faker->timezone(),
            "status" => $this->faker->randomElement([0, 1])
        ];
    }
}
