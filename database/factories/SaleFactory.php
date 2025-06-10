<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
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
            'total_harga' => $this->faker->numberBetween(10000, 100000),
            'diterima' => $this->faker->numberBetween(10000, 100000),
            'kembali' => $this->faker->numberBetween(0, 10000),
            'tanggal' => $this->faker->date(),
            'jam' => $this->faker->time(),
        ];
    }
}
