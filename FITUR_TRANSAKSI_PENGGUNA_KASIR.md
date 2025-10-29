# Fitur Transaksi Pengguna untuk Kasir

## Deskripsi
Fitur ini memungkinkan kasir untuk melihat, memproses, dan mengonfirmasi transaksi yang dibuat oleh pengguna (customer) melalui sistem keranjang belanja.

## Perubahan yang Dibuat

### 1. Route Baru (web.php)
```php
// Transaksi pengguna routes
Route::get('/kasir/transaksi-pengguna', [KasirDashboardController::class, 'transaksiPengguna'])->name('kasir.transaksi-pengguna');
Route::get('/kasir/transaksi-pengguna/{id}', [KasirDashboardController::class, 'detailTransaksiPengguna'])->name('kasir.transaksi-pengguna.detail');
Route::post('/kasir/transaksi-pengguna/{id}/konfirmasi', [KasirDashboardController::class, 'konfirmasiTransaksi'])->name('kasir.transaksi-pengguna.konfirmasi');
Route::post('/kasir/transaksi-pengguna/{id}/tolak', [KasirDashboardController::class, 'tolakTransaksi'])->name('kasir.transaksi-pengguna.tolak');
```

### 2. Controller Methods Baru (KasirDashboardController.php)
- `transaksiPengguna()` - Menampilkan daftar transaksi dari pengguna
- `detailTransaksiPengguna()` - Menampilkan detail transaksi pengguna
- `konfirmasiTransaksi()` - Mengonfirmasi transaksi dan mengurangi stok
- `tolakTransaksi()` - Menolak transaksi dengan alasan

### 3. Views Baru
- `resources/views/kasir/transaksi-pengguna.blade.php` - Halaman daftar transaksi pengguna
- `resources/views/kasir/transaksi-pengguna-detail.blade.php` - Halaman detail transaksi pengguna

### 4. Perubahan Database
- Menambahkan kolom `confirmed_at` dan `cancelled_at` pada tabel `transaksis`
- Mengubah nama kolom `harga_satuan` menjadi `harga` pada tabel `transaksi_details`

### 5. Perubahan Logic Checkout
- Status transaksi pengguna berubah dari `completed` menjadi `waiting_confirmation`
- Stok produk tidak langsung dikurangi saat checkout, tetapi setelah kasir konfirmasi
- Transaksi disimpan dengan `member_id` untuk menandai pembeli

## Alur Kerja Fitur

### Untuk Pengguna:
1. Pengguna menambahkan produk ke keranjang
2. Pengguna melakukan checkout
3. Transaksi tersimpan dengan status `waiting_confirmation`
4. Stok produk belum dikurangi
5. Pengguna menunggu konfirmasi dari kasir

### Untuk Kasir:
1. Kasir mengakses menu "Transaksi Pengguna" di dashboard
2. Kasir melihat daftar transaksi yang perlu dikonfirmasi
3. Kasir dapat melihat detail transaksi
4. Kasir dapat:
   - **Konfirmasi**: Transaksi disetujui, stok dikurangi, status menjadi `completed`
   - **Tolak**: Transaksi ditolak dengan alasan, status menjadi `cancelled`

## Fitur Dashboard
- Counter transaksi pending dan menunggu konfirmasi
- Filter berdasarkan status transaksi
- Modal konfirmasi untuk penolakan transaksi
- Real-time updates menggunakan AJAX
- Toast notifications untuk feedback

## Menu Navigasi
Menambahkan menu "Transaksi Pengguna" di sidebar kasir dengan ikon shopping cart.

## Status Transaksi
- `pending` - Transaksi baru dibuat
- `waiting_confirmation` - Menunggu konfirmasi kasir
- `completed` - Dikonfirmasi kasir, stok sudah dikurangi
- `cancelled` - Ditolak kasir

## Keamanan
- Hanya kasir dan admin yang dapat mengakses fitur ini
- Validasi stok sebelum konfirmasi transaksi
- CSRF protection pada semua form
- Pengecekan authorization di setiap method

## Testing
Fitur ini sudah siap untuk ditest dengan:
1. Login sebagai pengguna, lakukan checkout
2. Login sebagai kasir, lihat transaksi pengguna
3. Konfirmasi atau tolak transaksi
4. Verifikasi perubahan stok dan status
