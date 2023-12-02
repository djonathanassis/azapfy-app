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
            'date_emissary' =>  "2023-12-01 01:23:14",
            'cnpj_retirement' => "23326986000190",
            'name_retirement' => (string) $this->faker->name,
            'cnpj_transporter' => "23326986000190",
            'name_transporter' => (string) $this->faker->name,
        ];
    }
}
