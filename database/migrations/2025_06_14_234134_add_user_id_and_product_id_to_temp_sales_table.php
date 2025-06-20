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
        Schema::table('temp_sales', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->unsignedBigInteger('product_id')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_sales', function (Blueprint $table) {
            //
             $table->dropColumn('user_id');
            $table->dropColumn('product_id');
        });
    }
};
