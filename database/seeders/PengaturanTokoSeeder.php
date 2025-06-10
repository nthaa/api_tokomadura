<?php

namespace Database\Seeders;

use App\Http\Resources\PengaturanToko;
use App\Models\PengaturanToko as ModelsPengaturanToko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanTokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ModelsPengaturanToko::factory()->count(1)->create();

    }
}
