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
        //
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('total_harga')->nullable()->change();
            $table->integer('diterima')->nullable()->change();
            $table->integer('kembali')->nullable()->change();
            $table->date('tanggal')->nullable()->change();
            $table->time('jam')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('sales', function (Blueprint $table) {
        });
    }
};
