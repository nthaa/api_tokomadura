<?php

namespace Database\Seeders;

use App\Models\PurchaseDetail;
use App\Models\TempSale;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();
        // ([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',

        // ]);
        $this->call([
            QuoteSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            SaleDetailSeeder::class,
            PurchaseSeeder::class,
            PurchaseDetailSeeder::class,
            TempSaleSeeder::class,
            TempPurchaseSeeder::class,
        ]);
    }
}
