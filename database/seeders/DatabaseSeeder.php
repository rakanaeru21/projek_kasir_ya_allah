<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user dengan role Admin
        User::create([
            'nama' => 'Naufal',
            'nomor_telepon' => '081234567890',
            'email' => 'rakanaeru@gmail.com',
            'password' => bcrypt('qwerty212'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Buat user dengan role Kasir
        User::create([
            'nama' => 'Kasir 1',
            'nomor_telepon' => '081234567891',
            'email' => 'kasir@kasir.com',
            'password' => bcrypt('qwerty212'),
            'role' => 'kasir',
            'is_active' => true,
        ]);

        User::create([
            'nama' => 'Kasir 2',
            'nomor_telepon' => '081234567892',
            'email' => 'kasir2@kasir.com',
            'password' => bcrypt('kasir123'),
            'role' => 'kasir',
            'is_active' => true,
        ]);

        // Buat user dengan role Pengguna
        User::create([
            'nama' => 'Pengguna Biasa',
            'nomor_telepon' => '081234567893',
            'email' => 'pengguna@kasir.com',
            'password' => bcrypt('qwerty212'),
            'role' => 'pengguna',
            'is_active' => true,
        ]);

        User::create([
            'nama' => 'Pengguna 2',
            'nomor_telepon' => '081234567894',
            'email' => 'pengguna2@kasir.com',
            'password' => bcrypt('pengguna123'),
            'role' => 'pengguna',
            'is_active' => true,
        ]);

        // Jalankan seeder produk dan promo
        $this->call([
            ProdukSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
