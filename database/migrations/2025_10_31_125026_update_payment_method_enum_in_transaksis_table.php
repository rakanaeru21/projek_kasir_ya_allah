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
        Schema::table('transaksis', function (Blueprint $table) {
            // Drop the old enum column
            $table->dropColumn('payment_method');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            // Add the new enum column with updated values
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'aerucoin', 'mixed'])->after('customer_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Drop the new enum column
            $table->dropColumn('payment_method');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            // Restore the old enum column
            $table->enum('payment_method', ['cash', 'card', 'transfer'])->after('customer_name');
        });
    }
};
