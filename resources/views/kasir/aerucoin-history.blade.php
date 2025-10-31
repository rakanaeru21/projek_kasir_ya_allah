{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\kasir\aerucoin-history.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>History AeruCoin - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
:root {
    --color-primary: #cd4fb8;
    --color-primary-light: #e06dd0;
    --color-primary-dark: #b3329d;
    --color-secondary: #FFE900;
    --color-secondary-light: #FFF654;
    --color-bg: #1B3C53;
    --color-bg-alt: #152e42;
    --color-text: #F5F5F5;
    --color-text-muted: #b8c5d0;
    --sidebar-width: 280px;
    --card-bg: #234a65;
    --card-hover-bg: #2a5672;
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
   Layout Structure
   ======================================== */
.app-layout {
    display: flex;
    min-height: 100vh;
}

/* ========================================
   Sidebar Navigation
   ======================================== */
.sidebar {
    width: var(--sidebar-width);
    background: linear-gradient(180deg, #0f2332 0%, #1B3C53 100%);
    color: white;
    position: fixed;
    height: 100vh;
    left: 0;
    top: 0;
    overflow-y: auto;
    transition: transform 0.3s ease;
    z-index: 1000;
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
    border-right: 1px solid rgba(205, 79, 184, 0.2);
}

.sidebar-header {
    padding: 24px 20px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
    text-align: center;
    background: rgba(205, 79, 184, 0.1);
}

.sidebar-header h2 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--color-text);
}

.sidebar-header p {
    font-size: 14px;
    opacity: 0.8;
    color: var(--color-text-muted);
}

.sidebar-menu {
    padding: 20px 0;
}

.menu-item {
    display: flex;
    align-items: center;
    padding: 16px 24px;
    color: var(--color-text-muted);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.menu-item:hover {
    background: rgba(205, 79, 184, 0.15);
    color: var(--color-text);
    border-left-color: var(--color-primary);
}

.menu-item.active {
    background: rgba(205, 79, 184, 0.2);
    color: var(--color-text);
    border-left-color: var(--color-primary);
}

.menu-item:hover i {
    color: var(--color-primary-light);
}

.menu-item.active i {
    color: var(--color-primary);
}

.menu-item i {
    font-size: 18px;
    margin-right: 16px;
    width: 24px;
    text-align: center;
    color: var(--color-text-muted);
    transition: color 0.3s ease;
}

.menu-item span {
    font-weight: 500;
}

.sidebar-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    background: rgba(15, 35, 50, 0.5);
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-weight: bold;
    color: white;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.user-details h4 {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
    color: var(--color-text);
}

.user-details p {
    font-size: 12px;
    opacity: 0.8;
    color: var(--color-text-muted);
}

/* ========================================
   Main Content Area
   ======================================== */
.main-content {
    flex: 1;
    margin-left: var(--sidebar-width);
    min-height: 100vh;
    background: var(--color-bg-alt);
}

/* ========================================
   Navbar - Top Navigation
   ======================================== */
.navbar {
    background: var(--card-bg);
    color: var(--color-text);
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
}

.navbar-left {
    display: flex;
    align-items: center;
}

.sidebar-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 24px;
    color: var(--color-text);
    cursor: pointer;
    margin-right: 16px;
}

.navbar h2 {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.5px;
    color: var(--color-text);
}

.btn-logout {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.btn-logout:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
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
   Card Styles
   ======================================== */
.card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 3px solid var(--color-primary);
}

.card-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--color-text);
    display: flex;
    align-items: center;
    gap: 12px;
}

/* ========================================
   Form Styles
   ======================================== */
.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr auto;
    gap: 16px;
    align-items: end;
    margin-bottom: 24px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--color-text);
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px 14px;
    background: var(--color-bg);
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    color: var(--color-text);
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
    background: var(--color-bg-alt);
}

.form-select {
    background-image: url("data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='%23F5F5F5' fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

/* ========================================
   Button Styles
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20934a 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.6);
}

/* ========================================
   Table Styles
   ======================================== */
.table-responsive {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid rgba(205, 79, 184, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table th,
.table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
    vertical-align: middle;
}

.table th {
    background: var(--color-bg);
    color: var(--color-primary);
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background: rgba(205, 79, 184, 0.05);
}

.table tbody tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.02);
}

/* ========================================
   Stats Cards
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    border: 1px solid rgba(205, 79, 184, 0.2);
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--color-primary);
    margin-bottom: 12px;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: 8px;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--color-text-muted);
    font-weight: 500;
}

/* ========================================
   Pagination Styles
   ======================================== */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid rgba(205, 79, 184, 0.1);
}

.pagination {
    display: flex;
    list-style: none;
    gap: 8px;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    color: var(--color-text-muted);
    background: var(--color-bg);
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-weight: 500;
    min-width: 44px;
}

.pagination .page-link:hover {
    background: var(--color-primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.pagination .page-item.active .page-link {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}

.pagination .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}

/* ========================================
   Empty State
   ======================================== */
.empty-state {
    text-align: center;
    padding: 60px 40px;
    color: var(--color-text-muted);
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
    color: var(--color-primary);
}

.empty-state h3 {
    font-size: 1.4rem;
    margin-bottom: 12px;
    color: var(--color-text);
}

.empty-state p {
    font-size: 1rem;
    line-height: 1.5;
}

/* ========================================
   Mobile Sidebar Overlay
   ======================================== */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 999;
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar-overlay.active {
        display: block;
    }

    .main-content {
        margin-left: 0;
    }

    .sidebar-toggle {
        display: block;
    }

    .navbar {
        padding: 16px 20px;
    }

    .navbar h2 {
        font-size: 20px;
    }

    .container {
        padding: 0 20px;
        margin: 24px auto;
    }

    .card {
        padding: 20px;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .table th,
    .table td {
        padding: 12px 16px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .table th,
    .table td {
        padding: 10px 12px;
        font-size: 12px;
    }

    .pagination .page-link {
        padding: 8px 12px;
        font-size: 13px;
        min-width: 40px;
    }
}
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cash-register"></i> AeruStore</h2>
                <p>Kasir Panel</p>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('kasir.dashboard') }}" class="menu-item">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kasir.transaksi') }}" class="menu-item">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span>
                </a>
                <a href="{{ route('aerucoin.index') }}" class="menu-item active">
                    <i class="fas fa-coins"></i>
                    <span>Topup AeruCoin</span>
                </a>
                <a href="{{ route('kasir.aerucoin.requests') }}" class="menu-item">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Request AeruCoin</span>
                </a>
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pengguna</span>
                </a>
                <a href="{{ route('kasir.history') }}" class="menu-item">
                    <i class="fas fa-history"></i>
                    <span>History Transaksi</span>
                </a>
                <a href="{{ route('kasir.laporan') }}" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr(auth()->user()->nama, 0, 1) }}
                    </div>
                    <div class="user-details">
                        <h4>{{ auth()->user()->nama }}</h4>
                        <p>{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout" style="width: 100%;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <main class="main-content">
            <nav class="navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                    <h2><i class="fas fa-history"></i> History AeruCoin</h2>
                </div>
                <div class="navbar-right">
                    <a href="{{ route('aerucoin.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i>
                        Topup Baru
                    </a>
                </div>
            </nav>

            <div class="container">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="stat-value">{{ $totalTransactions }}</div>
                        <div class="stat-label">Total Transaksi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-value">{{ number_format($totalCash, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Uang Tunai (Rp)</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="stat-value">{{ number_format($totalCoins, 0, ',', '.') }}</div>
                        <div class="stat-label">Total AeruCoin</div>
                    </div>
                </div>

                <!-- Filter Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-filter"></i>
                            Filter Transaksi
                        </h2>
                    </div>

                    <form method="GET" action="{{ route('aerucoin.history') }}">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                       value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                       value="{{ request('end_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="user_search" class="form-label">Cari User</label>
                                <input type="text" name="user_search" id="user_search" class="form-control"
                                       placeholder="Nama atau No. Telepon" value="{{ request('user_search') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Filter
                                </button>
                                <a href="{{ route('aerucoin.history') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- History Table Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-list-alt"></i>
                            Daftar Transaksi AeruCoin
                        </h2>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <span style="color: var(--color-text-muted); font-size: 14px;">
                                {{ $transactions->total() }} transaksi ditemukan
                            </span>
                        </div>
                    </div>

                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>User</th>
                                        <th>Kontak</th>
                                        <th>Jumlah Coin</th>
                                        <th>Uang Tunai</th>
                                        <th>Kasir</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $index => $transaction)
                                        <tr>
                                            <td style="font-weight: 600; color: var(--color-primary);">
                                                {{ $transactions->firstItem() + $index }}
                                            </td>
                                            <td>
                                                <div style="display: flex; flex-direction: column;">
                                                    <span style="font-weight: 600;">
                                                        {{ $transaction->created_at->format('d/m/Y') }}
                                                    </span>
                                                    <span style="font-size: 12px; color: var(--color-text-muted);">
                                                        {{ $transaction->created_at->format('H:i:s') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">
                                                        {{ substr($transaction->user->nama, 0, 1) }}
                                                    </div>
                                                    <span style="font-weight: 500;">{{ $transaction->user->nama }}</span>
                                                </div>
                                            </td>
                                            <td style="color: var(--color-text-muted);">
                                                {{ $transaction->user->nomor_telepon }}
                                            </td>
                                            <td>
                                                <span style="font-weight: 700; color: var(--color-secondary); font-size: 15px;">
                                                    {{ number_format($transaction->amount, 0, ',', '.') }}
                                                </span>
                                                <span style="color: var(--color-text-muted); font-size: 12px;">Coin</span>
                                            </td>
                                            <td>
                                                <span style="font-weight: 600; color: #28a745;">
                                                    Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td style="color: var(--color-text-muted);">
                                                {{ $transaction->kasir->nama }}
                                            </td>
                                            <td style="color: var(--color-text-muted); font-style: italic;">
                                                {{ $transaction->description ?: '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            {{ $transactions->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-coins"></i>
                            <h3>Belum Ada Transaksi</h3>
                            <p>
                                @if(request()->hasAny(['start_date', 'end_date', 'user_search']))
                                    Tidak ada transaksi yang sesuai dengan filter yang dipilih.<br>
                                    Coba ubah kriteria pencarian atau reset filter.
                                @else
                                    Belum ada transaksi topup AeruCoin yang tercatat.<br>
                                    Mulai lakukan topup untuk melihat history di sini.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle for Mobile
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });

            // Auto-set end date when start date is selected
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            startDateInput.addEventListener('change', function() {
                if (this.value && !endDateInput.value) {
                    endDateInput.value = this.value;
                }
            });

            // Close sidebar on window resize if desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });

            // Table row hover effects
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(4px)';
                    this.style.transition = 'transform 0.2s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>
