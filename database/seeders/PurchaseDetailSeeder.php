<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Pastikan ada data di purchase dan products
        if (Purchase::count() === 0 || Product::count() === 0) {
            echo "Purchases atau Products kosong\n";
            return;
        }

        // Membuat data PurchaseDetail dengan purchase_id dan product_id yang valid
        PurchaseDetail::factory()->count(25)->create([
            'purchase_id' => Purchase::inRandomOrder()->first()->id ?? Purchase::factory(),
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
        ]);
    }
}
