<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing transaksi_details with product information
        DB::statement("
            UPDATE transaksi_details td
            LEFT JOIN produks p ON td.produk_id = p.id
            SET
                td.nama_produk = COALESCE(p.nama_produk, CONCAT('Produk ID: ', td.produk_id)),
                td.kategori_produk = COALESCE(p.kategori, 'Tidak Diketahui')
            WHERE td.nama_produk IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset the columns
        DB::table('transaksi_details')->update([
            'nama_produk' => null,
            'kategori_produk' => null
        ]);
    }
};
