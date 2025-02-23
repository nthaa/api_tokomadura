<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Mengambil data sales dan produk
         $sales = Sale::all();
         $products = Product::all();

         // Pastikan ada data di sales dan products
         if ($sales->isEmpty() || $products->isEmpty()) {
            //  dd('Sales atau Products kosong');
         }

         // Membuat data SaleDetail dengan sale_id dan product_id yang valid
         SaleDetail::factory()
             ->count(25)  // Atur jumlah sesuai kebutuhan
             ->create([
                 'sale_id' => $sales->random()->id,  // Random sale_id dari tabel sales
                 'product_id' => $products->random()->id,  // Random product_id dari tabel products
             ]);

        //  dd('SaleDetail seeder selesai');
     }

}
