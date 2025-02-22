<?php

namespace Database\Seeders;

use App\Models\TempSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TempSale::factory()->count(25)->create();
    }
}
