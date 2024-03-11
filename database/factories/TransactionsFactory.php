<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "transaction_date" => $this->faker->dateTimeBetween("-10 year", "now"),
            "transaction_type_id" => $this->faker->numberBetween(1, 3),
            "from_account_id" => $this->faker->numberBetween(1, 16),
            "to_account_id" => $this->faker->numberBetween(1, 16),
            "amount" => $this->faker->numberBetween(1000, 100000),
            "transaction_code" => $this->faker->unique()->username(),
        ];
    }
}
