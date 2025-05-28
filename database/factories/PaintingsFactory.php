<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paintings>
 */
class PaintingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'img' => $this->faker->imageUrl(),
            'name' => $this->faker->name(),
            'medium' => $this->faker->randomElement(['Oil', 'Acril', 'Watercolor']),
            'width' => $this->faker->randomNumber(3),
            'length' => $this->faker->randomNumber(3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
