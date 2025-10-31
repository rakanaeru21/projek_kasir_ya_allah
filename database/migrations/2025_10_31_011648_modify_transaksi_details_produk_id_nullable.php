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
        Schema::table('transaksi_details', function (Blueprint $table) {
            // Drop existing foreign key constraint
            $table->dropForeign(['produk_id']);

            // Modify column to be nullable
            $table->unsignedBigInteger('produk_id')->nullable()->change();

            // Add new foreign key constraint with SET NULL on delete
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            // Drop the nullable foreign key
            $table->dropForeign(['produk_id']);

            // Restore original constraint (not nullable)
            $table->unsignedBigInteger('produk_id')->nullable(false)->change();

            // Add back original foreign key constraint
            $table->foreign('produk_id')->references('id')->on('produks');
        });
    }
};
