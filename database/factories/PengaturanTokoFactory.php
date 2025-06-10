<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaturanToko>
 */
class PengaturanTokoFactory extends Factory
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
            'nama_toko' => $this->faker->company,
            'alamat' => $this->faker->address,
            'no_telp' => $this->faker->phoneNumber,
        ];
    }
}
