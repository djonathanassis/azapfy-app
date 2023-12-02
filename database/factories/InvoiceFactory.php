<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => (string) $this->faker->numberBetween(100000000, 999999999),
            'amount' =>  $this->faker->numberBetween(0, 9999),
            'cnpj_retirement' => (string) $this->faker->numberBetween(10000000000000, 99999999999999),
            'name_retirement' => (string) $this->faker->name,
            'cnpj_transporter' => (string) $this->faker->numberBetween(10000000000000, 99999999999999),
            'name_transporter' => (string) $this->faker->name,
        ];
    }
}
