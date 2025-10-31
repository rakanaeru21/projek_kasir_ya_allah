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
        Schema::create('aerucoin_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('User yang mengajukan request');
            $table->decimal('amount', 15, 2)->comment('Jumlah AeruCoin yang diminta');
            $table->decimal('cash_amount', 15, 2)->comment('Jumlah uang tunai yang disetor');
            $table->text('description')->nullable()->comment('Keterangan/alasan request');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('Status request');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null')->comment('Kasir yang menyetujui/menolak');
            $table->text('approval_notes')->nullable()->comment('Catatan dari kasir');
            $table->timestamp('approved_at')->nullable()->comment('Waktu disetujui/ditolak');
            $table->timestamps();

            // Index untuk performa query
            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
            $table->index('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aerucoin_requests');
    }
};
