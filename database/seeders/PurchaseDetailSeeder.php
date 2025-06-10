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
         // Mengambil data purchases dan products
         $purchases = Purchase::all();
         $products = Product::all();

         // Pastikan ada data di purchases dan products
         if ($purchases->isEmpty() || $products->isEmpty()) {
            //  dd('Purchases atau Products kosong');
         }

         // Membuat data PurchaseDetail dengan purchase_id dan product_id yang valid
         PurchaseDetail::factory()
             ->count(25)  // Atur jumlah sesuai kebutuhan
             ->create([
                 'purchase_id' => $purchases->random()->id,  // Random purchase_id dari tabel sales
                 'product_id' => $products->random()->id,  // Random product_id dari tabel products
             ]);

        //  dd('PurchaseDetail seeder selesai');
    }
}
