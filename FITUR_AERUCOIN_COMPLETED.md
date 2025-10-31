# FITUR AERUCOIN - SISTEM TOPUP DIGITAL

## Overview
Fitur AeruCoin adalah sistem topup digital yang memungkinkan user untuk menyimpan saldo dalam bentuk coin yang dapat digunakan untuk transaksi di AeruStore. Fitur ini dikelola oleh kasir untuk melakukan topup ke akun pengguna.

## Komponen yang Dibuat

### 1. Database Schema

#### Migration Files:
- `2025_10_31_030812_add_aerucoin_balance_to_users_table.php`
  - Menambahkan kolom `aerucoin_balance` ke tabel `users`
  - Tipe data: decimal(15,2) dengan default 0
  
- `2025_10_31_030826_create_aerucoin_transactions_table.php`
  - Membuat tabel `aerucoin_transactions` untuk tracking semua transaksi
  - Kolom: id, user_id, kasir_id, amount, cash_received, type, description, reference_id, timestamps
  - Foreign keys ke tabel users untuk user_id dan kasir_id
  - Indexes untuk performa query yang optimal

### 2. Models

#### User Model (Updated)
**File:** `app/Models/User.php`
**Fitur Baru:**
- `aerucoin_balance` ditambahkan ke fillable
- Cast `aerucoin_balance` ke decimal:2
- Method `addAeruCoin($amount)` - menambah saldo
- Method `subtractAeruCoin($amount)` - mengurangi saldo
- Method `hasEnoughAeruCoin($amount)` - cek kecukupan saldo
- Method `getFormattedAeruCoinBalanceAttribute()` - format saldo untuk display
- Relasi ke AeruCoinTransaction

#### AeruCoinTransaction Model (New)
**File:** `app/Models/AeruCoinTransaction.php`
**Fitur:**
- Model untuk tracking semua transaksi AeruCoin
- Relasi ke User (user dan kasir)
- Scope methods untuk filter berdasarkan tipe transaksi
- Format methods untuk display amount dan cash received

### 3. Controller

#### AeruCoinController (New)
**File:** `app/Http/Controllers/AeruCoinController.php`
**Methods:**
- `index()` - Halaman utama topup AeruCoin
- `topup(Request $request)` - Proses topup dengan validasi
- `getUserDetail($id)` - API untuk mendapatkan detail user
- `history(Request $request)` - Halaman history transaksi dengan filter
- `checkBalance($phoneNumber)` - API untuk cek saldo berdasarkan nomor telepon

### 4. Views

#### Halaman Topup AeruCoin
**File:** `resources/views/kasir/aerucoin-topup.blade.php`
**Fitur:**
- Form topup dengan dropdown user selection
- Auto-display informasi user saat dipilih
- Auto-calculate AeruCoin amount berdasarkan cash received (ratio 1:1)
- Real-time form validation
- AJAX form submission tanpa refresh page
- Display transaksi terakhir
- Responsive design dengan tema AeruStore

#### Halaman History AeruCoin  
**File:** `resources/views/kasir/aerucoin-history.blade.php`
**Fitur:**
- Tabel history semua transaksi AeruCoin
- Filter berdasarkan user, tipe transaksi, dan range tanggal
- Pagination untuk performa optimal
- Badge untuk tipe transaksi (topup, usage, refund)
- Responsive table design

### 5. Routes

#### Routes AeruCoin (Added to web.php)
```php
// AeruCoin routes (di dalam kasir middleware group)
Route::get('/aerucoin', [AeruCoinController::class, 'index'])->name('aerucoin.index');
Route::post('/aerucoin/topup', [AeruCoinController::class, 'topup'])->name('aerucoin.topup');
Route::get('/aerucoin/user/{id}', [AeruCoinController::class, 'getUserDetail'])->name('aerucoin.user.detail');
Route::get('/aerucoin/history', [AeruCoinController::class, 'history'])->name('aerucoin.history');
Route::get('/aerucoin/check-balance/{phoneNumber}', [AeruCoinController::class, 'checkBalance'])->name('aerucoin.check-balance');
```

### 6. Integration

#### Dashboard Kasir (Updated)
**File:** `resources/views/kasir/dashboard.blade.php`
- Menu "Topup AeruCoin" ditambahkan ke sidebar navigation
- Icon menggunakan `fas fa-coins`

## Cara Menggunakan

### 1. Untuk Kasir:

#### Melakukan Topup:
1. Login sebagai kasir
2. Klik menu "Topup AeruCoin" di sidebar
3. Pilih user dari dropdown
4. Masukkan jumlah uang tunai yang diterima
5. Jumlah AeruCoin akan otomatis terisi (ratio 1:1)
6. Tambahkan keterangan jika diperlukan
7. Klik "Proses Topup"

#### Melihat History:
1. Dari halaman topup, klik "Lihat Semua"
2. Atau akses langsung `/aerucoin/history`
3. Gunakan filter untuk mencari transaksi tertentu
4. Export laporan (fitur future)

### 2. Untuk User:
- Saldo AeruCoin tersimpan di akun masing-masing
- Dapat dilihat di dashboard user (future feature)
- Dapat digunakan untuk transaksi (future feature)

## API Endpoints

### GET /aerucoin/user/{id}
Mendapatkan detail user untuk topup
**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "nama": "Ahmad Fauzi",
        "nomor_telepon": "081234567890",
        "current_balance": "15,000",
        "current_balance_raw": 15000
    }
}
```

### POST /aerucoin/topup
Proses topup AeruCoin
**Request:**
```json
{
    "user_id": 1,
    "cash_received": 50000,
    "amount": 50000,
    "description": "Topup bulanan"
}
```
**Response:**
```json
{
    "success": true,
    "message": "Topup AeruCoin berhasil!",
    "data": {
        "user_name": "Ahmad Fauzi",
        "amount": "50,000",
        "new_balance": "65,000",
        "transaction_id": 1
    }
}
```

### GET /aerucoin/check-balance/{phoneNumber}
Cek saldo berdasarkan nomor telepon
**Response:**
```json
{
    "success": true,
    "data": {
        "user_id": 1,
        "nama": "Ahmad Fauzi",
        "balance": "65,000",
        "balance_raw": 65000
    }
}
```

## Security Features

1. **Authentication Required:** Semua routes memerlukan login
2. **Role-based Access:** Hanya kasir dan admin yang dapat mengakses
3. **CSRF Protection:** Semua POST requests dilindungi CSRF token
4. **Validation:** Input validation pada semua form
5. **Database Transactions:** Menggunakan DB transaction untuk konsistensi data

## Performance Optimizations

1. **Database Indexes:** Index pada kolom yang sering di-query
2. **Pagination:** History menggunakan pagination untuk data besar
3. **Eager Loading:** Menggunakan `with()` untuk relasi
4. **Caching:** Format saldo menggunakan accessor untuk performa

## Future Enhancements

1. **Pembayaran dengan AeruCoin:** Integrasi dengan sistem transaksi existing
2. **Refund System:** Fitur refund AeruCoin
3. **Laporan AeruCoin:** Laporan khusus untuk AeruCoin
4. **Notifikasi:** Notifikasi saat topup berhasil
5. **QR Code:** Topup menggunakan QR code
6. **Mobile App Integration:** API untuk mobile app
7. **Promo AeruCoin:** Sistem promo khusus AeruCoin

## Testing Data

Seeder `AeruCoinUserSeeder` membuat 5 user testing:
1. Ahmad Fauzi (081234567890) - Saldo: 0
2. Siti Nurhaliza (081234567891) - Saldo: 15,000
3. Budi Santoso (081234567892) - Saldo: 25,000
4. Rina Wati (081234567893) - Saldo: 5,000
5. Dodi Hermawan (081234567894) - Saldo: 0

## Installation & Setup

1. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

2. **Seed Test Data:**
   ```bash
   php artisan db:seed --class=AeruCoinUserSeeder
   ```

3. **Access Feature:**
   - Login sebagai kasir
   - Buka `/aerucoin` atau klik menu "Topup AeruCoin"

## Troubleshooting

### Common Issues:

1. **Route not found:** Pastikan routes sudah ditambahkan dan cache di-clear
2. **CSRF token mismatch:** Pastikan meta csrf-token ada di head section
3. **Permission denied:** Pastikan user memiliki role kasir atau admin
4. **Migration failed:** Pastikan tidak ada konflik dengan existing schema

### Debug Commands:
```bash
php artisan route:list | grep aerucoin
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Kesimpulan

Fitur AeruCoin telah berhasil diimplementasikan dengan lengkap. Sistem ini memungkinkan kasir untuk melakukan topup digital ke akun pengguna dengan tracking yang comprehensive. Semua komponen terintegrasi dengan baik dan siap untuk digunakan dalam production environment.

Fitur ini dapat menjadi foundation untuk pengembangan sistem pembayaran digital yang lebih kompleks di masa depan, seperti pembayaran menggunakan AeruCoin, sistem poin loyalty, dan integrasi dengan payment gateway.
