<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel sales
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            // Menghubungkan ke tabel products
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer("jumlah");
            $table->integer("harga_jual_trx");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
