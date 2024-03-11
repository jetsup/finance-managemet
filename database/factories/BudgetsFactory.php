<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budgets>
 */
class BudgetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
            "department_id" => $this->faker->numberBetween(1, 6),
            "project_name" => $this->faker->name(),
            "allocated_amount" => $this->faker->numberBetween(100000, 10000000),
            "allocation_date" => $this->faker->dateTimeBetween("-10 year", "now"),
        ];
    }
}
