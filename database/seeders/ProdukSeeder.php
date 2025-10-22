<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produks = [
            [
                'kode_produk' => 'PRD001',
                'nama_produk' => 'Indomie Goreng',
                'deskripsi' => 'Mie instan rasa goreng',
                'kategori' => 'Makanan',
                'harga' => 3500,
                'stok' => 100,
                'satuan' => 'pcs',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD002',
                'nama_produk' => 'Aqua 600ml',
                'deskripsi' => 'Air mineral kemasan',
                'kategori' => 'Minuman',
                'harga' => 4000,
                'stok' => 50,
                'satuan' => 'botol',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD003',
                'nama_produk' => 'Beras Premium',
                'deskripsi' => 'Beras kualitas terbaik',
                'kategori' => 'Sembako',
                'harga' => 15000,
                'stok' => 30,
                'satuan' => 'kg',
                'status' => 'aktif'
            ]
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
