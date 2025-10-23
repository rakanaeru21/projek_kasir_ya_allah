<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoProduKTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('promo_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id')->constrained('promos')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->timestamps();

            // Menghindari duplikat relasi
            $table->unique(['promo_id', 'produk_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('promo_produk');
    }
}
