<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "employee_number" => "TSC" . $this->faker->unique()->numberBetween(100000, 999999) . "/" . date("Y"),
            "user_id" => $this->faker->unique()->numberBetween(1, 11),
            "employee_type_id" => $this->faker->numberBetween(1, 12),
        ];
    }
}
