# Fitur Request AeruCoin - Dokumentasi

## Overview
Fitur ini memungkinkan user (pengguna) untuk mengajukan request penambahan AeruCoin yang memerlukan persetujuan dari kasir. Sistem ini memberikan kontrol tambahan untuk kasir dalam mengelola topup AeruCoin.

## Komponen yang Dibuat

### 1. Database & Model

#### Migration: `create_aerucoin_requests_table.php`
- **Tabel**: `aerucoin_requests`
- **Kolom**:
  - `id` - Primary key
  - `user_id` - Foreign key ke tabel users (yang mengajukan request)
  - `amount` - Jumlah AeruCoin yang diminta
  - `cash_amount` - Jumlah uang tunai yang disetor
  - `description` - Keterangan/alasan request (opsional)
  - `status` - Status request (pending/approved/rejected)
  - `approved_by` - Foreign key ke users (kasir yang menyetujui/menolak)
  - `approval_notes` - Catatan dari kasir
  - `approved_at` - Timestamp persetujuan/penolakan
  - `created_at` & `updated_at` - Timestamps

#### Model: `AeruCoinRequest.php`
- **Relasi**:
  - `user()` - Ke user yang mengajukan request
  - `approvedBy()` - Ke kasir yang menyetujui/menolak
- **Scope**:
  - `pending()` - Request yang menunggu persetujuan
  - `approved()` - Request yang disetujui
  - `rejected()` - Request yang ditolak
  - `forUser($userId)` - Request untuk user tertentu
- **Methods**:
  - `approve($kasirId, $notes)` - Approve request dan tambah AeruCoin
  - `reject($kasirId, $notes)` - Reject request
  - `getFormattedAmountAttribute()` - Format jumlah dengan separator
  - `getStatusBadgeAttribute()` - HTML badge untuk status

### 2. Controller

#### `AeruCoinRequestController.php`
- **User Methods**:
  - `index()` - Tampilkan daftar request milik user
  - `store()` - Submit request baru dari user
- **Kasir Methods**:
  - `kasirIndex()` - Tampilkan semua request untuk kasir
  - `approve()` - Setujui request
  - `reject()` - Tolak request
- **Shared Methods**:
  - `show()` - Detail request (bisa diakses user dan kasir)

### 3. Views

#### Untuk User (Pengguna):
1. **Dashboard Enhancement** (`pengguna/dashboard.blade.php`):
   - Form modal untuk request AeruCoin
   - Section pending requests
   - Button "Request Tambah AeruCoin" di AeruCoin balance card

2. **Request History** (`pengguna/aerucoin-requests.blade.php`):
   - Daftar semua request user dengan status
   - Timeline dan detail request
   - Pagination

#### Untuk Kasir:
1. **Manage Requests** (`kasir/aerucoin-requests.blade.php`):
   - Dashboard dengan statistik pending/approved/rejected
   - Filter berdasarkan status
   - Modal untuk approve/reject dengan form catatan
   - Real-time update pending count

#### Shared:
1. **Detail View** (`shared/aerucoin-request-detail.blade.php`):
   - Detail lengkap request dengan timeline
   - Informasi user yang mengajukan
   - Status approval dan catatan kasir

### 4. Routes

```php
// Untuk User (Pengguna)
Route::get('/pengguna/aerucoin-requests', 'AeruCoinRequestController@index')->name('aerucoin.request.index');
Route::post('/pengguna/aerucoin-requests', 'AeruCoinRequestController@store')->name('aerucoin.request.store');

// Untuk Kasir
Route::get('/kasir/aerucoin-requests', 'AeruCoinRequestController@kasirIndex')->name('kasir.aerucoin.requests');
Route::patch('/kasir/aerucoin-requests/{aerucoinRequest}/approve', 'AeruCoinRequestController@approve')->name('aerucoin.request.approve');
Route::patch('/kasir/aerucoin-requests/{aerucoinRequest}/reject', 'AeruCoinRequestController@reject')->name('aerucoin.request.reject');

// Shared (Detail)
Route::get('/aerucoin-requests/{aerucoinRequest}', 'AeruCoinRequestController@show')->name('aerucoin.request.show');
```

## Fitur Utama

### 1. User Workflow
1. **Request Creation**:
   - User mengklik tombol "Request Tambah AeruCoin" di dashboard
   - Modal form muncul dengan field:
     - Jumlah AeruCoin (minimal 1,000 AC)
     - Jumlah uang tunai (auto-fill berdasarkan AeruCoin 1:1)
     - Keterangan (opsional)
   - Form validation untuk range amount dan required fields
   - Auto-submit dengan loading state

2. **Request Tracking**:
   - Pending requests ditampilkan di dashboard utama
   - Halaman khusus untuk melihat semua request history
   - Status badge dengan warna berbeda untuk setiap status
   - Detail timeline untuk setiap request

### 2. Kasir Workflow
1. **Dashboard Management**:
   - Statistik cards menampilkan count pending/approved/rejected
   - Filter tabs untuk melihat request berdasarkan status
   - Real-time update counter setiap 30 detik

2. **Approval Process**:
   - Modal konfirmasi untuk approve/reject
   - Field wajib untuk alasan penolakan
   - Field opsional untuk catatan approval
   - Transaction-safe approval (database transaction)

3. **Automatic Processing**:
   - Saat approve: AeruCoin otomatis ditambahkan ke saldo user
   - Record AeruCoinTransaction dibuat otomatis
   - Status user dan timestamp di-update

## Validasi & Security

### 1. Form Validation
- **Amount**: Minimal 1,000 - Maksimal 1,000,000
- **Cash Amount**: Minimal 1,000 - Maksimal 1,000,000
- **Description**: Maksimal 500 karakter
- **Approval Notes**: Required untuk reject, maksimal 500 karakter

### 2. Authorization
- User hanya bisa melihat request milik sendiri
- Kasir bisa melihat semua request
- Role-based access control di routes

### 3. Data Integrity
- Database transaction untuk approval process
- Foreign key constraints
- Soft delete protection untuk related records

## UI/UX Features

### 1. Responsive Design
- Mobile-friendly dengan sidebar collapsible
- Grid layout yang adaptif
- Touch-friendly buttons dan forms

### 2. Real-time Updates
- Auto-refresh pending count
- Loading states untuk semua form submissions
- Success/error messages dengan styling konsisten

### 3. Visual Feedback
- Color-coded status badges
- Progress timeline untuk request
- Hover effects dan smooth transitions
- Icon-based navigation

## Database Relations

```
users (1) ----< aerucoin_requests (n)
users (1) ----< aerucoin_requests.approved_by (n)
aerucoin_requests (1) ----< aerucoin_transactions.reference_id (1)
```

## Best Practices Implemented

1. **Code Organization**:
   - Separation of concerns (Controller, Model, View)
   - Reusable components dan consistent styling
   - Proper naming conventions

2. **Database Design**:
   - Proper indexing untuk performance
   - Timestamps untuk audit trail
   - Nullable fields untuk optional data

3. **Security**:
   - CSRF protection
   - Input validation dan sanitization
   - Authorization checks

4. **User Experience**:
   - Clear feedback messages
   - Intuitive navigation
   - Progressive disclosure untuk complex forms

## Testing Considerations

### 1. Manual Testing Checklist
- [ ] User dapat submit request dengan valid data
- [ ] Validation errors muncul untuk invalid data
- [ ] Kasir dapat approve request dan AeruCoin bertambah
- [ ] Kasir dapat reject request dengan alasan
- [ ] Timeline dan status updates berfungsi
- [ ] Responsive design di mobile devices
- [ ] Navigation menu berfungsi di semua halaman

### 2. Edge Cases
- [ ] Request dari user yang sudah dihapus
- [ ] Approval dari kasir yang sudah dihapus
- [ ] Concurrent approval dari multiple kasir
- [ ] Request dengan amount 0 atau negatif
- [ ] XSS protection pada text fields

Fitur ini telah berhasil diimplementasikan dan siap untuk testing lebih lanjut serta deployment.
