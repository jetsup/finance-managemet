<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeMessages>
 */
class EmployeeMessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prev_msg_id" => 0,
            "for" => $this->faker->numberBetween(1, 10),
            "from" => $this->faker->numberBetween(1, 10),
            "message" => $this->faker->text(100),
        ];
    }
}
