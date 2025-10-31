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
        Schema::create('aerucoin_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('User yang menerima topup');
            $table->foreignId('kasir_id')->constrained('users')->onDelete('cascade')->comment('Kasir yang melakukan topup');
            $table->decimal('amount', 15, 2)->comment('Jumlah AeruCoin yang ditopup');
            $table->decimal('cash_received', 15, 2)->comment('Uang tunai yang diterima');
            $table->enum('type', ['topup', 'usage', 'refund'])->default('topup')->comment('Jenis transaksi');
            $table->string('description')->nullable()->comment('Keterangan transaksi');
            $table->string('reference_id')->nullable()->comment('ID referensi untuk transaksi terkait');
            $table->timestamps();

            // Index untuk performa query
            $table->index(['user_id', 'created_at']);
            $table->index(['kasir_id', 'created_at']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aerucoin_transactions');
    }
};
