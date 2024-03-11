<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComplainsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "for" => $this->faker->numberBetween(1, 10),
            "from" => $this->faker->numberBetween(1, 10),
            "subject" => $this->faker->sentence(),
            "message" => $this->faker->paragraph(),
        ];
    }
}
