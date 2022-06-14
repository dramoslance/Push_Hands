<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organizer>
 */
class OrganizerFactory extends Factory
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
            "portrait" => $this->faker->imageUrl(100, 100),
            "email" => $this->faker->unique()->safeEmail(),
            "phone" => $this->faker->phoneNumber,
            "website" => $this->faker->url,
        ];
    }
}
