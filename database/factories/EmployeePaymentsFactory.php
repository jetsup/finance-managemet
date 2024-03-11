<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeePayments>
 */
class EmployeePaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "employee_id" => $this->faker->numberBetween(1, 11),
            "due_amount" => $this->faker->numberBetween(1, 5), // KES.1-5 for tests :)
            "total_received" => $this->faker->numberBetween(1000, 100000),
            // "transaction_id" => $this->faker->numberBetween(1, 1000),
        ];
    }
}
