<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TempSale>
 */
class TempSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'jumlah' => $this->faker->randomNumber(1,100),
            'harga' => $this->faker->numberBetween(1000, 10000),
            'total' => $this->faker->numberBetween(10000, 100000),

        ];
    }
}
