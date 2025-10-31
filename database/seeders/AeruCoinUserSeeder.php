<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AeruCoinUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa user pengguna untuk testing AeruCoin
        $users = [
            [
                'nama' => 'Ahmad Fauzi',
                'nomor_telepon' => '081234567890',
                'email' => 'ahmad.fauzi@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'is_active' => true,
                'aerucoin_balance' => 0,
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'nomor_telepon' => '081234567891',
                'email' => 'siti.nurhaliza@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'is_active' => true,
                'aerucoin_balance' => 15000,
            ],
            [
                'nama' => 'Budi Santoso',
                'nomor_telepon' => '081234567892',
                'email' => 'budi.santoso@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'is_active' => true,
                'aerucoin_balance' => 25000,
            ],
            [
                'nama' => 'Rina Wati',
                'nomor_telepon' => '081234567893',
                'email' => 'rina.wati@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'is_active' => true,
                'aerucoin_balance' => 5000,
            ],
            [
                'nama' => 'Dodi Hermawan',
                'nomor_telepon' => '081234567894',
                'email' => 'dodi.hermawan@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'is_active' => true,
                'aerucoin_balance' => 0,
            ],
        ];

        foreach ($users as $userData) {
            // Cek apakah user sudah ada berdasarkan nomor telepon
            $existingUser = User::where('nomor_telepon', $userData['nomor_telepon'])->first();

            if (!$existingUser) {
                User::create($userData);
                $this->command->info("User {$userData['nama']} berhasil dibuat");
            } else {
                $this->command->info("User {$userData['nama']} sudah ada, melewati...");
            }
        }
    }
}
