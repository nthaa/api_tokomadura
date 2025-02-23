<?php

namespace Database\Seeders;

use App\Models\TempPurchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TempPurchase::factory()->count(25)->create();
    }
}
