<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName(),
            'is_default' => $this->faker->boolean(),
            'entity_id' => $this->faker->randomElement([1, 10]),
            'entity_name' => $this->faker->randomElement(['cluster', 'event']),
        ];
    }
}
