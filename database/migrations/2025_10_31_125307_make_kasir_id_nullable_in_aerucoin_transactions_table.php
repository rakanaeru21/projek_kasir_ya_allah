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
        Schema::table('aerucoin_transactions', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['kasir_id']);

            // Modify the column to be nullable
            $table->foreignId('kasir_id')->nullable()->change();

            // Re-add the foreign key constraint with nullable support
            $table->foreign('kasir_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aerucoin_transactions', function (Blueprint $table) {
            // Drop the nullable foreign key
            $table->dropForeign(['kasir_id']);

            // Restore the non-nullable foreign key
            $table->foreignId('kasir_id')->change();
            $table->foreign('kasir_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
