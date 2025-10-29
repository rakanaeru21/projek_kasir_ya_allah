# Testing Guide - Fitur Transaksi Pengguna untuk Kasir

## Cara Test Fitur

### 1. Setup Testing
1. Pastikan server Laravel berjalan: `php artisan serve`
2. Pastikan database sudah di-migrate
3. Pastikan ada user dengan role 'pengguna' dan 'kasir'

### 2. Test sebagai Pengguna
1. Login sebagai pengguna
2. Tambahkan produk ke keranjang
3. Lakukan checkout - isi form checkout
4. Klik "Bayar Sekarang"
5. Verifikasi mendapat pesan sukses dengan kode transaksi
6. Transaksi statusnya akan `waiting_confirmation`

### 3. Test sebagai Kasir
1. Login sebagai kasir
2. Lihat dashboard kasir - ada badge notifikasi transaksi baru
3. Klik menu "Transaksi Pengguna"
4. Lihat daftar transaksi yang perlu dikonfirmasi
5. Klik "Detail" untuk melihat detail transaksi
6. Konfirmasi atau tolak transaksi
7. Verifikasi stok produk berkurang setelah konfirmasi

### 4. Verifikasi
- Status transaksi berubah dari `waiting_confirmation` ke `completed` atau `cancelled`
- Stok produk berkurang setelah konfirmasi
- Transaksi muncul di history pengguna dengan status yang benar
- Badge notifikasi di dashboard kasir berkurang

### 5. Error Handling
- Test jika stok tidak mencukupi saat konfirmasi
- Test validasi form checkout
- Test jika transaksi tidak ditemukan

## Expected Behavior

### User Flow:
Pengguna → Checkout → Status: waiting_confirmation → Kasir Konfirmasi → Status: completed

### Kasir Flow:
Login → Dashboard (lihat badge) → Transaksi Pengguna → Detail → Konfirmasi/Tolak

## Troubleshooting

Jika error `user_id doesn't have a default value`:
- Pastikan migration `make_user_id_nullable` sudah dijalankan
- Pastikan status enum sudah diupdate dengan `waiting_confirmation`
