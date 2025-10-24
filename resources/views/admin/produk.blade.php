{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\admin\produk.blade.php --}}
@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Produk[] $produks */
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Produk - Kasir Yaallah</title>
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
:root {
    --color-primary: #cd4fb8;
    --color-primary-light: #cd4fb8;
    --color-primary-dark: #cd4fb8;
    --color-secondary: #FFE900;
    --color-secondary-light: #FFF654;
    --color-bg: #1B3C53;
    --color-bg-alt: #1B3C53;
    --color-text: #F5F5F5;
    --color-text-muted: #f5f5f5;
}

/* ========================================
   Reset & Base Styles
   ======================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: var(--color-bg-alt);
    color: var(--color-text);
}

/* ========================================
   Navbar - Top Navigation
   ======================================== */
.navbar {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: white;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.navbar h2 {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.nav-left { display: flex; align-items: center; gap: 12px; }
        .nav-center { display: flex; gap: 16px; align-items: center; }
        .nav-right { display: flex; align-items: center; gap: 12px; }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: background .25s, color .25s, transform .25s, opacity .25s;
            opacity: .9;
        }
        .nav-link:hover {
            background: rgba(255,255,255,.15);
            opacity: 1;
            transform: translateY(-1px);
        }
        .nav-link.active {
            background: #ffffff;
            color: var(--color-primary);
            box-shadow: 0 2px 8px rgba(7,203,115,.25);
        }

.btn-logout {
    background: white;
    color: var(--color-primary);
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.btn-logout:hover {
    background: var(--color-bg-alt);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-logout:active {
    transform: translateY(0);
}

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 40px;
}

/* ========================================
   Welcome Card - Hero Section
   ======================================== */
.welcome-card {
    background: #234C6A;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border-left: 6px solid var(--color-primary);
}

.welcome-card h1 {
    color: var(--color-text);
    margin-bottom: 16px;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.welcome-card p {
    color: var(--color-text-muted);
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

.welcome-card p strong {
    color: var(--color-primary);
    font-weight: 600;
}

.info-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 12px;
    box-shadow: 0 2px 8px rgba(255, 0, 123, 0.3);
}

/* ========================================
   Stats Grid - Dashboard Statistics
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-top: 30px;
}

.stat-card {
    background: #234C6A;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border-bottom: 4px solid var(--color-primary);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.stat-card h3 {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    font-size: 36px;
    font-weight: 700;
    color: var(--color-primary);
    line-height: 1;
}

/* ========================================
   Quick Actions - Action Buttons
   ======================================== */
.quick-actions {
    background: #234C6A;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-top: 30px;
}

.quick-actions h2 {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.action-btn {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 16px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px #dc72cb;
    text-align: center;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px #dc72cb;
}

.action-btn:active {
    transform: translateY(0);
}

/* ========================================
   Table Styles
   ======================================== */
.table-wrapper {
    overflow-x: auto;
    margin-top: 20px;
}

.product-table {
    width: 100%;
    border-collapse: collapse;
    background: #2d5f7f;
    border-radius: 8px;
    overflow: hidden;
}

.product-table thead {
    background: var(--color-primary);
}

.product-table thead th {
    padding: 16px;
    text-align: left;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.product-table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.product-table tbody tr:hover {
    background: rgba(255, 255, 255, 0.05);
}

.product-table tbody tr:last-child {
    border-bottom: none;
}

.product-table tbody td {
    padding: 16px;
    color: #F5F5F5;
    font-size: 14px;
}

.product-table tbody td:first-child {
    font-weight: 600;
    color: #F5F5F5;
}

.product-code {
    font-family: 'Courier New', monospace;
    font-weight: 700;
    color: var(--color-primary);
    background: rgba(205, 79, 184, 0.2);
    padding: 4px 8px;
    border-radius: 6px;
    display: inline-block;
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-aktif {
    background: #4CAF50;
    color: white;
}

.status-nonaktif {
    background: #f44336;
    color: white;
}

.btn-action {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    margin-right: 8px;
}

.btn-edit {
    background: #2196F3;
    color: white;
}

.btn-edit:hover {
    background: #1976D2;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
}

.btn-delete {
    background: #f44336;
    color: white;
}

.btn-delete:hover {
    background: #d32f2f;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
}

.empty-state {
    padding: 60px 40px;
    text-align: center;
    color: var(--color-text-muted);
}

.empty-state-icon {
    font-size: 64px;
    margin-bottom: 16px;
    opacity: 0.5;
}

.empty-state-text {
    font-size: 16px;
    color: var(--color-text-muted);
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
@media (max-width: 768px) {
    .navbar {
        padding: 16px 20px;
        flex-direction: column;
        gap: 16px;
    }

    .navbar h2 {
        font-size: 20px;
    }

    .container {
        padding: 0 20px;
        margin: 24px auto;
    }

    .welcome-card {
        padding: 24px;
    }

    .welcome-card h1 {
        font-size: 24px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .action-buttons {
        grid-template-columns: 1fr;
    }
}

/* ========================================
   Modal Styles
   ======================================== */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background-color: #234C6A;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: white;
    padding: 20px 30px;
    border-radius: 12px 12px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 600;
}

.close {
    color: white;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    line-height: 1;
}

.close:hover {
    transform: rotate(90deg);
    opacity: 0.8;
}

.modal-body {
    padding: 30px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--color-text);
    font-weight: 600;
    font-size: 14px;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    background: #1B3C53;
    color: var(--color-text);
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.modal-footer {
    padding: 20px 30px;
    border-top: 2px solid rgba(205, 79, 184, 0.2);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn-cancel {
    background: #6c757d;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-submit {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 12px 32px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.4);
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.error-message {
    color: #ff5252;
    font-size: 12px;
    margin-top: 4px;
    display: none;
}

.form-group.error input,
.form-group.error textarea,
.form-group.error select {
    border-color: #ff5252;
}

.form-group.error .error-message {
    display: block;
}

/* ========================================
   Image Preview Styles
   ======================================== */
.image-preview-container {
    margin-top: 12px;
    text-align: center;
}

.image-preview {
    max-width: 200px;
    max-height: 200px;
    border-radius: 8px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    padding: 4px;
    background: #1B3C53;
}

.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid rgba(205, 79, 184, 0.3);
}

.no-image {
    width: 60px;
    height: 60px;
    background: rgba(205, 79, 184, 0.1);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    border: 2px dashed rgba(205, 79, 184, 0.3);
}

.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-wrapper input[type=file] {
    position: absolute;
    left: -9999px;
}

.file-input-label {
    display: block;
    padding: 12px 16px;
    background: #1B3C53;
    border: 2px dashed rgba(205, 79, 184, 0.5);
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    color: var(--color-text);
}

.file-input-label:hover {
    border-color: var(--color-primary);
    background: rgba(205, 79, 184, 0.1);
}

.file-name {
    margin-top: 8px;
    font-size: 12px;
    color: var(--color-primary);
    font-weight: 600;
}

/* ========================================
   Pagination Styles
   ======================================== */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding: 20px;
    background: rgba(205, 79, 184, 0.05);
    border-radius: 8px;
    flex-wrap: wrap;
    gap: 16px;
}

.pagination-info {
    color: var(--color-text);
    font-size: 14px;
}

.pagination-info strong {
    color: var(--color-primary);
    font-weight: 600;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 12px;
}

.per-page-selector {
    display: flex;
    align-items: center;
    gap: 8px;
}

.per-page-selector label {
    color: var(--color-text);
    font-size: 14px;
    font-weight: 500;
}

.per-page-selector select {
    padding: 8px 12px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 6px;
    background: #1B3C53;
    color: var(--color-text);
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.per-page-selector select:focus {
    outline: none;
    border-color: var(--color-primary);
}

.pagination-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.pagination-btn {
    padding: 8px 16px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 6px;
    background: #1B3C53;
    color: var(--color-text);
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    min-width: 40px;
    text-align: center;
}

.pagination-btn:hover:not(:disabled) {
    background: var(--color-primary);
    border-color: var(--color-primary);
    transform: translateY(-2px);
}

.pagination-btn.active {
    background: var(--color-primary);
    border-color: var(--color-primary);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.3);
}

.pagination-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.page-numbers {
    display: flex;
    gap: 4px;
}

@media (max-width: 768px) {
    .pagination-container {
        flex-direction: column;
        align-items: stretch;
    }

    .pagination-controls {
        flex-direction: column;
        align-items: stretch;
    }

    .pagination-buttons {
        justify-content: center;
        flex-wrap: wrap;
    }
}
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <h2>🛒 Kasir Yaallah</h2>
        </div>

        <div class="nav-center">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('admin.produk') }}" class="nav-link {{ request()->routeIs('admin.produk') ? 'active' : '' }}">Produk</a>
            <a href="{{ route('admin.promo') }}" class="nav-link {{ request()->routeIs('admin.promo') ? 'active' : '' }}">Promo</a>
            <a href="#" class="nav-link">Profil</a>
        </div>

        <div class="nav-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <!-- Product Management Section -->
        <div class="quick-actions">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <div>
                    <h2 style="margin: 0; border: none; padding: 0;">📦 Data Produk</h2>
                    <p style="color: var(--color-text-light); font-size: 14px; margin-top: 4px;">Kelola semua produk Anda di sini</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button class="action-btn" onclick="openModal()">
                        <span style="font-size: 18px;">+</span>
                        Tambah Produk
                    </button>
                </div>
            </div>

            <!-- Product Table -->
            <div class="table-wrapper">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th style="text-align: right;">Harga Normal</th>
                            <th style="text-align: right;">Harga Jual</th>
                            <th style="text-align: right;">Harga Diskon</th>
                            <th style="text-align: center;">Stok</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks ?? [] as $index => $produk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($produk->gambar && file_exists(public_path($produk->gambar)))
                                    <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="product-image">
                                @else
                                    <div class="no-image">📦</div>
                                @endif
                            </td>
                            <td><span class="product-code">{{ $produk->kode_produk }}</span></td>
                            <td style="font-weight: 600;">{{ $produk->nama_produk }}</td>
                            <td>
                                <span style="background: rgba(205, 79, 184, 0.3); color: #F5F5F5; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                    {{ $produk->kategori }}
                                </span>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #90CAF9;">
                                Rp {{ number_format((float)$produk->harga_normal, 0, ',', '.') }}
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #81C784;">
                                Rp {{ number_format((float)$produk->harga_untung, 0, ',', '.') }}
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #FFB74D;">
                                @if($produk->harga_diskon)
                                    <span style="color: #FF5722;">Rp {{ number_format((float)$produk->harga_diskon, 0, ',', '.') }}</span>
                                    <br><small style="color: #4CAF50; font-weight: 500;">🎯 Promo Aktif</small>
                                @else
                                    <span style="color: #9E9E9E; font-style: italic;">-</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <strong>{{ $produk->stok }}</strong> {{ $produk->satuan }}
                            </td>
                            <td style="text-align: center;">
                                <span class="status-badge status-{{ $produk->status == 'aktif' ? 'aktif' : 'nonaktif' }}">
                                    {{ $produk->status == 'aktif' ? '✓ Aktif' : '✕ Nonaktif' }}
                                </span>
                            </td>
                            <td style="text-align: center; white-space: nowrap;">
                                <button onclick="editProduk({{ $produk->id }})" class="btn-action btn-edit">
                                    ✏️ Edit
                                </button>
                                <button onclick="hapusProduk({{ $produk->id }})" class="btn-action btn-delete">
                                    🗑️ Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="empty-state">
                                <div class="empty-state-icon">📦</div>
                                <div class="empty-state-text">Belum ada data produk</div>
                                <p style="margin-top: 8px; font-size: 14px;">Klik tombol "Tambah Produk" untuk menambahkan produk baru</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Menampilkan <strong id="showingFrom">{{ $produks->firstItem() ?? 0 }}</strong>
                    sampai <strong id="showingTo">{{ $produks->lastItem() ?? 0 }}</strong>
                    dari <strong id="totalItems">{{ $produks->total() }}</strong> produk
                </div>

                <div class="pagination-controls">
                    <div class="per-page-selector">
                        <label for="perPage">Tampilkan:</label>
                        <select id="perPage" onchange="changePerPage(this.value)">
                            <option value="5" {{ $produks->perPage() == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $produks->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $produks->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $produks->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $produks->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <div class="pagination-buttons">
                        <button class="pagination-btn" onclick="goToPage(1)" {{ $produks->currentPage() == 1 ? 'disabled' : '' }}>
                            ⏮️ First
                        </button>
                        <button class="pagination-btn" onclick="goToPage({{ $produks->currentPage() - 1 }})" {{ !$produks->previousPageUrl() ? 'disabled' : '' }}>
                            ◀️ Prev
                        </button>

                        <div class="page-numbers" id="pageNumbers">
                            @php
                                $currentPage = $produks->currentPage();
                                $lastPage = $produks->lastPage();
                                $start = max(1, $currentPage - 2);
                                $end = min($lastPage, $currentPage + 2);
                            @endphp

                            @if($start > 1)
                                <button class="pagination-btn" onclick="goToPage(1)">1</button>
                                @if($start > 2)
                                    <span style="padding: 8px; color: var(--color-text);">...</span>
                                @endif
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                <button class="pagination-btn {{ $i == $currentPage ? 'active' : '' }}" onclick="goToPage({{ $i }})">
                                    {{ $i }}
                                </button>
                            @endfor

                            @if($end < $lastPage)
                                @if($end < $lastPage - 1)
                                    <span style="padding: 8px; color: var(--color-text);">...</span>
                                @endif
                                <button class="pagination-btn" onclick="goToPage({{ $lastPage }})">{{ $lastPage }}</button>
                            @endif
                        </div>

                        <button class="pagination-btn" onclick="goToPage({{ $produks->currentPage() + 1 }})" {{ !$produks->nextPageUrl() ? 'disabled' : '' }}>
                            Next ▶️
                        </button>
                        <button class="pagination-btn" onclick="goToPage({{ $produks->lastPage() }})" {{ $produks->currentPage() == $produks->lastPage() ? 'disabled' : '' }}>
                            Last ⏭️
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Produk -->
    <div id="produkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Produk</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="produkForm">
                @csrf
                <input type="hidden" id="produkId" name="produk_id">
                <input type="hidden" id="formMethod" name="_method" value="POST">

                <div class="modal-body">
                    <!-- Info Kode Produk (hanya tampil saat edit) -->
                    <div class="form-group" id="kodeProdukInfo" style="display: none;">
                        <label>Kode Produk</label>
                        <div style="background: rgba(205, 79, 184, 0.2); padding: 12px 16px; border-radius: 8px; border: 2px solid rgba(205, 79, 184, 0.3);">
                            <span class="product-code" id="displayKodeProduk" style="background: transparent; padding: 0;"></span>
                        </div>
                        <small style="color: var(--color-text-muted); font-size: 12px; margin-top: 4px; display: block;">
                            ℹ️ Kode produk dibuat otomatis dan tidak dapat diubah
                        </small>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk *</label>
                            <input type="text" id="nama_produk" name="nama_produk" required placeholder="Contoh: Indomie Goreng">
                            <span class="error-message" id="error_nama_produk"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi produk (opsional)"></textarea>
                        <span class="error-message" id="error_deskripsi"></span>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar Produk</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                            <label for="gambar" class="file-input-label">
                                📷 Pilih Gambar
                                <div class="file-name" id="fileName"></div>
                            </label>
                        </div>
                        <div class="image-preview-container" id="imagePreviewContainer" style="display: none;">
                            <img id="imagePreview" class="image-preview" src="" alt="Preview">
                        </div>
                        <span class="error-message" id="error_gambar"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="kategori">Kategori *</label>
                            <input type="text" id="kategori" name="kategori" required placeholder="Contoh: Makanan">
                            <span class="error-message" id="error_kategori"></span>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan *</label>
                            <select id="satuan" name="satuan" required>
                                <option value="">Pilih Satuan</option>
                                <option value="pcs">Pcs (Pieces)</option>
                                <option value="kg">Kg (Kilogram)</option>
                                <option value="liter">Liter</option>
                                <option value="botol">Botol</option>
                                <option value="box">Box</option>
                                <option value="pack">Pack</option>
                                <option value="dus">Dus</option>
                            </select>
                            <span class="error-message" id="error_satuan"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga_normal">Harga Normal (Modal) *</label>
                            <input type="number" id="harga_normal" name="harga_normal" required min="0" step="0.01" placeholder="0">
                            <span class="error-message" id="error_harga_normal"></span>
                        </div>
                        <div class="form-group">
                            <label for="harga_untung">Harga Jual (Untung) *</label>
                            <input type="number" id="harga_untung" name="harga_untung" required min="0" step="0.01" placeholder="0">
                            <span class="error-message" id="error_harga_untung"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga_diskon">Harga Diskon</label>
                            <input type="number" id="harga_diskon" name="harga_diskon" min="0" step="0.01" placeholder="0" readonly>
                            <span class="error-message" id="error_harga_diskon"></span>
                            <small style="color: #FFB74D; font-size: 12px; margin-top: 4px; display: block;">
                                ℹ️ Harga diskon akan otomatis terisi jika produk memiliki promo aktif
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok *</label>
                            <input type="number" id="stok" name="stok" required min="0" placeholder="0">
                            <span class="error-message" id="error_stok"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select id="status" name="status" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                            <span class="error-message" id="error_status"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-submit" id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        // Tambahkan meta csrf jika belum ada
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = '{{ csrf_token() }}';
            document.head.appendChild(meta);
        }

        function openModal() {
            document.getElementById('produkModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Tambah Produk';
            document.getElementById('produkForm').reset();
            document.getElementById('produkId').value = '';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('fileName').textContent = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('kodeProdukInfo').style.display = 'none'; // Sembunyikan info kode produk
            clearErrors();
        }

        function closeModal() {
            document.getElementById('produkModal').style.display = 'none';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('kodeProdukInfo').style.display = 'none';
            clearErrors();
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const fileName = document.getElementById('fileName');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');

            if (file) {
                fileName.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                fileName.textContent = '';
                previewContainer.style.display = 'none';
            }
        }

        function clearErrors() {
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error');
            });
            document.querySelectorAll('.error-message').forEach(msg => {
                msg.textContent = '';
                msg.style.display = 'none';
            });
        }

        function showErrors(errors) {
            clearErrors();
            Object.keys(errors).forEach(key => {
                const errorElement = document.getElementById('error_' + key);
                const formGroup = errorElement?.closest('.form-group');
                if (errorElement && formGroup) {
                    formGroup.classList.add('error');
                    errorElement.textContent = errors[key][0];
                    errorElement.style.display = 'block';
                }
            });
        }

        async function editProduk(id) {
            try {
                const response = await fetch(`/admin/produk/${id}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {
                    const produk = result.data;

                    document.getElementById('modalTitle').textContent = 'Edit Produk';
                    document.getElementById('produkId').value = produk.id;
                    document.getElementById('formMethod').value = 'PUT';

                    // Tampilkan info kode produk (read-only)
                    document.getElementById('kodeProdukInfo').style.display = 'block';
                    document.getElementById('displayKodeProduk').textContent = produk.kode_produk;

                    document.getElementById('nama_produk').value = produk.nama_produk;
                    document.getElementById('deskripsi').value = produk.deskripsi || '';
                    document.getElementById('kategori').value = produk.kategori;
                    document.getElementById('harga_normal').value = produk.harga_normal;
                    document.getElementById('harga_untung').value = produk.harga_untung;
                    document.getElementById('harga_diskon').value = produk.harga_diskon || '';
                    document.getElementById('stok').value = produk.stok;
                    document.getElementById('satuan').value = produk.satuan;
                    document.getElementById('status').value = produk.status;

                    // Show existing image if available
                    const previewContainer = document.getElementById('imagePreviewContainer');
                    const preview = document.getElementById('imagePreview');
                    const fileName = document.getElementById('fileName');

                    if (produk.gambar) {
                        preview.src = '/' + produk.gambar;
                        previewContainer.style.display = 'block';
                        fileName.textContent = 'Gambar saat ini: ' + produk.gambar.split('/').pop();
                    } else {
                        previewContainer.style.display = 'none';
                        fileName.textContent = '';
                    }

                    document.getElementById('produkModal').style.display = 'block';
                } else {
                    alert('Gagal mengambil data produk');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data produk');
            }
        }

        async function hapusProduk(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                return;
            }

            try {
                const response = await fetch(`/admin/produk/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message || 'Gagal menghapus produk');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus produk');
            }
        }

        document.getElementById('produkForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';

            const formElement = e.target;
            const formData = new FormData(formElement);
            const produkId = document.getElementById('produkId').value;
            const method = document.getElementById('formMethod').value;

            // Tambahkan _method untuk PUT request
            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }

            try {
                const url = produkId ? `/admin/produk/${produkId}` : '/admin/produk';
                const response = await fetch(url, {
                    method: 'POST', // Selalu gunakan POST, Laravel akan handle _method
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    closeModal();
                    location.reload();
                } else {
                    if (result.errors) {
                        showErrors(result.errors);
                    } else {
                        alert(result.message || 'Terjadi kesalahan');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Simpan';
            }
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('produkModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // ========================================
        // Pagination Functions
        // ========================================
        let currentPage = {{ $produks->currentPage() }};
        let perPage = {{ $produks->perPage() }};
        let lastPage = {{ $produks->lastPage() }};

        function goToPage(page) {
            if (page < 1 || page > lastPage || page === currentPage) {
                return;
            }

            currentPage = page;
            loadProducts();
        }

        function changePerPage(newPerPage) {
            perPage = newPerPage;
            currentPage = 1; // Reset to first page
            loadProducts();
        }

        async function loadProducts() {
            try {
                const response = await fetch(`/admin/produk?page=${currentPage}&per_page=${perPage}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    updateTable(result.data);
                    updatePagination(result);
                }
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        function updateTable(products) {
            const tbody = document.querySelector('.product-table tbody');

            if (products.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="10" class="empty-state">
                            <div class="empty-state-icon">📦</div>
                            <div class="empty-state-text">Belum ada data produk</div>
                            <p style="margin-top: 8px; font-size: 14px;">Klik tombol "Tambah Produk" untuk menambahkan produk baru</p>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            products.forEach((produk, index) => {
                const no = (currentPage - 1) * perPage + index + 1;
                const gambar = produk.gambar
                    ? `<img src="/${produk.gambar}" alt="${produk.nama_produk}" class="product-image">`
                    : `<div class="no-image">📦</div>`;

                const statusClass = produk.status === 'aktif' ? 'aktif' : 'nonaktif';
                const statusText = produk.status === 'aktif' ? '✓ Aktif' : '✕ Nonaktif';

                html += `
                    <tr>
                        <td>${no}</td>
                        <td>${gambar}</td>
                        <td><span class="product-code">${produk.kode_produk}</span></td>
                        <td style="font-weight: 600;">${produk.nama_produk}</td>
                        <td>
                            <span style="background: rgba(205, 79, 184, 0.3); color: #F5F5F5; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
                                ${produk.kategori}
                            </span>
                        </td>
                        <td style="text-align: right; font-weight: 600; color: #90CAF9;">
                            Rp ${formatNumber(produk.harga_normal)}
                        </td>
                        <td style="text-align: right; font-weight: 600; color: #81C784;">
                            Rp ${formatNumber(produk.harga_untung)}
                        </td>
                        <td style="text-align: right; font-weight: 600; color: #FFB74D;">
                            ${produk.harga_diskon ?
                                `<span style="color: #FF5722;">Rp ${formatNumber(produk.harga_diskon)}</span><br><small style="color: #4CAF50; font-weight: 500;">🎯 Promo Aktif</small>` :
                                `<span style="color: #9E9E9E; font-style: italic;">-</span>`
                            }
                        </td>
                        <td style="text-align: center;">
                            <strong>${produk.stok}</strong> ${produk.satuan}
                        </td>
                        <td style="text-align: center;">
                            <span class="status-badge status-${statusClass}">
                                ${statusText}
                            </span>
                        </td>
                        <td style="text-align: center; white-space: nowrap;">
                            <button onclick="editProduk(${produk.id})" class="btn-action btn-edit">
                                ✏️ Edit
                            </button>
                            <button onclick="hapusProduk(${produk.id})" class="btn-action btn-delete">
                                🗑️ Hapus
                            </button>
                        </td>
                    </tr>
                `;
            });

            tbody.innerHTML = html;
        }

        function updatePagination(data) {
            currentPage = data.current_page;
            lastPage = data.last_page;

            // Update info text
            document.getElementById('showingFrom').textContent = data.from || 0;
            document.getElementById('showingTo').textContent = data.to || 0;
            document.getElementById('totalItems').textContent = data.total;

            // Update page numbers
            const pageNumbersContainer = document.getElementById('pageNumbers');
            let html = '';

            const start = Math.max(1, currentPage - 2);
            const end = Math.min(lastPage, currentPage + 2);

            if (start > 1) {
                html += `<button class="pagination-btn" onclick="goToPage(1)">1</button>`;
                if (start > 2) {
                    html += `<span style="padding: 8px; color: var(--color-text);">...</span>`;
                }
            }

            for (let i = start; i <= end; i++) {
                const activeClass = i === currentPage ? 'active' : '';
                html += `<button class="pagination-btn ${activeClass}" onclick="goToPage(${i})">${i}</button>`;
            }

            if (end < lastPage) {
                if (end < lastPage - 1) {
                    html += `<span style="padding: 8px; color: var(--color-text);">...</span>`;
                }
                html += `<button class="pagination-btn" onclick="goToPage(${lastPage})">${lastPage}</button>`;
            }

            pageNumbersContainer.innerHTML = html;

            // Update navigation buttons
            updateNavigationButtons();
        }

        function updateNavigationButtons() {
            const buttons = document.querySelectorAll('.pagination-buttons > .pagination-btn');

            // First button
            buttons[0].disabled = currentPage === 1;
            buttons[0].onclick = () => goToPage(1);

            // Prev button
            buttons[1].disabled = currentPage === 1;
            buttons[1].onclick = () => goToPage(currentPage - 1);

            // Next button
            buttons[buttons.length - 2].disabled = currentPage === lastPage;
            buttons[buttons.length - 2].onclick = () => goToPage(currentPage + 1);

            // Last button
            buttons[buttons.length - 1].disabled = currentPage === lastPage;
            buttons[buttons.length - 1].onclick = () => goToPage(lastPage);
        }

        function formatNumber(num) {
            return parseFloat(num).toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }
    </script>
</body>
</html>
