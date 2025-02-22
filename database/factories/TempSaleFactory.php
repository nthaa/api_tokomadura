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
            'product_id' => $this->faker->unique()->randomNumber(),
            'nama' => $this->faker->name(),
            'jumlah' => $this->faker->randomNumber(),
            'harga' => $this->faker->numberBetween(1000, 10000),
            'total' => $this->faker->randomNumber(),
            'id_user' => $this->faker->unique()->randomNumber()
        ];
    }
}
