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
                'harga_normal' => 3000,
                'harga_untung' => 3500,
                'stok' => 100,
                'satuan' => 'pcs',
                'gambar' => 'indomie.svg',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD002',
                'nama_produk' => 'Aqua 600ml',
                'deskripsi' => 'Air mineral kemasan',
                'kategori' => 'Minuman',
                'harga_normal' => 3500,
                'harga_untung' => 4000,
                'stok' => 50,
                'satuan' => 'botol',
                'gambar' => 'aqua.svg',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD003',
                'nama_produk' => 'Beras Premium',
                'deskripsi' => 'Beras kualitas terbaik',
                'kategori' => 'Sembako',
                'harga_normal' => 13000,
                'harga_untung' => 15000,
                'stok' => 30,
                'satuan' => 'kg',
                'gambar' => 'beras.svg',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD004',
                'nama_produk' => 'Manga Boruto',
                'deskripsi' => 'Komik Boruto volume terbaru',
                'kategori' => 'Buku',
                'harga_normal' => 35000,
                'harga_untung' => 40000,
                'stok' => 15,
                'satuan' => 'pcs',
                'gambar' => '1761127260_boruto.jpg',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD005',
                'nama_produk' => 'Blue Lock Manga',
                'deskripsi' => 'Manga Blue Lock Volume 1',
                'kategori' => 'Buku',
                'harga_normal' => 32000,
                'harga_untung' => 37000,
                'stok' => 12,
                'satuan' => 'pcs',
                'gambar' => '1761127845_Blue_Lock_Vol_1.jpg',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD006',
                'nama_produk' => 'Slam Dunk Manga',
                'deskripsi' => 'Manga klasik Slam Dunk',
                'kategori' => 'Buku',
                'harga_normal' => 38000,
                'harga_untung' => 43000,
                'stok' => 8,
                'satuan' => 'pcs',
                'gambar' => '1761127074_Slam_Dunk_(manga)_1.png',
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD007',
                'nama_produk' => 'Minyak Goreng',
                'deskripsi' => 'Minyak goreng kemasan 1 liter',
                'kategori' => 'Sembako',
                'harga_normal' => 14000,
                'harga_untung' => 16000,
                'stok' => 25,
                'satuan' => 'liter',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD008',
                'nama_produk' => 'Kopi Kapal Api',
                'deskripsi' => 'Kopi bubuk sachet',
                'kategori' => 'Minuman',
                'harga_normal' => 1500,
                'harga_untung' => 2000,
                'stok' => 80,
                'satuan' => 'pcs',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD009',
                'nama_produk' => 'Telur Ayam',
                'deskripsi' => 'Telur ayam negeri',
                'kategori' => 'Sembako',
                'harga_normal' => 25000,
                'harga_untung' => 28000,
                'stok' => 20,
                'satuan' => 'kg',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD010',
                'nama_produk' => 'Sabun Mandi Lifebuoy',
                'deskripsi' => 'Sabun batang',
                'kategori' => 'Kebersihan',
                'harga_normal' => 3000,
                'harga_untung' => 4000,
                'stok' => 45,
                'satuan' => 'pcs',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD011',
                'nama_produk' => 'Shampo Pantene',
                'deskripsi' => 'Shampo sachet',
                'kategori' => 'Kebersihan',
                'harga_normal' => 1000,
                'harga_untung' => 1500,
                'stok' => 100,
                'satuan' => 'pcs',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD012',
                'nama_produk' => 'Pasta Gigi Pepsodent',
                'deskripsi' => 'Pasta gigi keluarga',
                'kategori' => 'Kebersihan',
                'harga_normal' => 8000,
                'harga_untung' => 10000,
                'stok' => 30,
                'satuan' => 'pcs',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD013',
                'nama_produk' => 'Biskuit Roma',
                'deskripsi' => 'Biskuit kelapa',
                'kategori' => 'Makanan',
                'harga_normal' => 5000,
                'harga_untung' => 6500,
                'stok' => 40,
                'satuan' => 'pack',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD014',
                'nama_produk' => 'Snack Chitato',
                'deskripsi' => 'Keripik kentang',
                'kategori' => 'Makanan',
                'harga_normal' => 8000,
                'harga_untung' => 10000,
                'stok' => 35,
                'satuan' => 'pack',
                'gambar' => null,
                'status' => 'aktif'
            ],
            [
                'kode_produk' => 'PRD015',
                'nama_produk' => 'Sikat Gigi Formula',
                'deskripsi' => 'Sikat gigi dewasa',
                'kategori' => 'Kebersihan',
                'harga_normal' => 5000,
                'harga_untung' => 7000,
                'stok' => 25,
                'satuan' => 'pcs',
                'gambar' => null,
                'status' => 'aktif'
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
