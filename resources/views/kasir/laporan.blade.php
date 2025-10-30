<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --error-color: #ef4444;
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

.btn-logout:active {
    transform: translateY(0);
}

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px 40px;
}

/* ========================================
   Filter Section
   ======================================== */
.filter-section {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.filter-section h3 {
    color: var(--color-text);
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text);
}

.form-input, .form-select {
    padding: 12px 16px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    background: var(--color-bg-alt);
    color: var(--color-text);
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
}

.btn-filter {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
}

/* ========================================
   Stats Grid - Dashboard Statistics
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    border: 1px solid rgba(205, 79, 184, 0.2);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
    background: var(--card-hover-bg);
}

.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.stat-card h3 {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-icon {
    font-size: 24px;
    color: var(--color-primary);
    opacity: 0.8;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary-light);
    line-height: 1;
    margin-bottom: 8px;
}

.stat-description {
    font-size: 12px;
    color: var(--color-text-muted);
}

/* ========================================
   Chart Section
   ======================================== */
.chart-section {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.chart-section h3 {
    color: var(--color-text);
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chart-container {
    position: relative;
    height: 300px;
}

/* ========================================
   Content Grid
   ======================================== */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 24px;
    margin-bottom: 24px;
}

/* ========================================
   Report Tables
   ======================================== */
.report-card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.report-card h3 {
    color: var(--color-text);
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.table-container {
    overflow-x: auto;
    margin-bottom: 20px;
}

.report-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

.report-table th {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.report-table th:first-child {
    border-top-left-radius: 8px;
}

.report-table th:last-child {
    border-top-right-radius: 8px;
}

.report-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
    color: var(--color-text-muted);
    background: rgba(35, 74, 101, 0.3);
    font-size: 14px;
}

.report-table tr:hover td {
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
}

/* ========================================
   Top Products Section
   ======================================== */
.top-products {
    max-height: 400px;
    overflow-y: auto;
}

.product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
}

.product-item:last-child {
    border-bottom: none;
}

.product-info h4 {
    color: var(--color-text);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
}

.product-info p {
    color: var(--color-text-muted);
    font-size: 12px;
}

.product-stats {
    text-align: right;
}

.product-stats .quantity {
    color: var(--color-primary-light);
    font-weight: 600;
    font-size: 16px;
}

.product-stats .revenue {
    color: var(--color-text-muted);
    font-size: 12px;
    margin-top: 4px;
}

/* ========================================
   Export Buttons
   ======================================== */
.export-section {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 12px;
    margin-top: 24px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.export-section h3 {
    color: var(--color-text);
    margin-bottom: 16px;
    font-size: 16px;
    font-weight: 600;
}

.export-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-export {
    background: var(--color-bg-alt);
    color: var(--color-text);
    padding: 10px 20px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-export:hover {
    border-color: var(--color-primary);
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
}

.btn-export.pdf {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-export.pdf:hover {
    background: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
}

.btn-export.excel {
    border-color: #198754;
    color: #198754;
}

.btn-export.excel:hover {
    background: rgba(25, 135, 84, 0.1);
    border-color: #198754;
}

/* ========================================
   Pagination
   ======================================== */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 24px;
    gap: 8px;
}

.pagination .page-link {
    padding: 8px 12px;
    background: var(--card-bg);
    color: var(--color-text-muted);
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
    border: 1px solid rgba(205, 79, 184, 0.2);
    font-size: 14px;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
}

.pagination .page-link.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
}

/* ========================================
   Empty State
   ======================================== */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--color-text-muted);
}

.empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 20px;
    margin-bottom: 12px;
    color: var(--color-text);
}

.empty-state p {
    font-size: 14px;
    line-height: 1.6;
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
   Responsive Design
   ======================================== */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
}

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
        padding: 16px 20px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .export-buttons {
        flex-direction: column;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .report-table {
        font-size: 12px;
    }

    .report-table th,
    .report-table td {
        padding: 8px 12px;
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
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pengguna</span>
                    @php
                        $transaksiMenungguKonfirmasi = \App\Models\Transaksi::where('status', 'menunggu_konfirmasi')->count();
                    @endphp
                    @if($transaksiMenungguKonfirmasi > 0)
                        <span style="
                            background: linear-gradient(135deg, #ff4757, #ff3742);
                            color: white;
                            font-size: 11px;
                            font-weight: 600;
                            padding: 2px 6px;
                            border-radius: 50%;
                            margin-left: auto;
                            min-width: 18px;
                            height: 18px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 2px 4px rgba(255, 71, 87, 0.4);
                            text-align: center;
                        ">{{ $transaksiMenungguKonfirmasi }}</span>
                    @endif
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('kasir.history') }}" class="menu-item">
                    <i class="fas fa-history"></i>
                    <span>History Transaksi</span>
                </a>
                <a href="{{ route('kasir.laporan') }}" class="menu-item active">
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
                    <h2>Laporan Penjualan</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <!-- Filter Section -->
                <div class="filter-section">
                    <h3><i class="fas fa-filter"></i> Filter Laporan</h3>
                    <form method="GET" action="{{ route('kasir.laporan') }}" class="filter-form">
                        <div class="form-group">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-input" value="{{ $tanggalMulai }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-input" value="{{ $tanggalSelesai }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Periode</label>
                            <select name="periode" class="form-select">
                                <option value="harian" {{ $periode == 'harian' ? 'selected' : '' }}>Harian</option>
                                <option value="mingguan" {{ $periode == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-filter">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div>
                                <h3>Transaksi Hari Ini</h3>
                                <div class="stat-number">{{ $totalTransaksiHariIni }}</div>
                                <p class="stat-description">Total transaksi yang berhasil</p>
                            </div>
                            <i class="fas fa-receipt stat-icon"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div>
                                <h3>Penjualan Hari Ini</h3>
                                <div class="stat-number">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</div>
                                <p class="stat-description">Total pendapatan hari ini</p>
                            </div>
                            <i class="fas fa-money-bill-wave stat-icon"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div>
                                <h3>Item Terjual Hari Ini</h3>
                                <div class="stat-number">{{ $totalItemTerjualHariIni }}</div>
                                <p class="stat-description">Total produk yang terjual</p>
                            </div>
                            <i class="fas fa-box-open stat-icon"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-header">
                            <div>
                                <h3>Penjualan Periode</h3>
                                <div class="stat-number">Rp {{ number_format($totalPenjualanPeriode, 0, ',', '.') }}</div>
                                <p class="stat-description">{{ $totalTransaksiPeriode }} transaksi, {{ $totalItemTerjualPeriode }} item</p>
                            </div>
                            <i class="fas fa-chart-trending-up stat-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-section">
                    <h3><i class="fas fa-chart-area"></i> Grafik Penjualan 7 Hari Terakhir</h3>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Transactions Table -->
                    <div class="report-card">
                        <h3>
                            <i class="fas fa-list"></i>
                            Transaksi Periode {{ date('d/m/Y', strtotime($tanggalMulai)) }} - {{ date('d/m/Y', strtotime($tanggalSelesai)) }}
                        </h3>

                        @if($transaksis->count() > 0)
                        <div class="table-container">
                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th>No. Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksis as $transaksi)
                                    <tr>
                                        <td><strong>#{{ $transaksi->id }}</strong></td>
                                        <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $transaksi->details->sum('quantity') }} item</td>
                                        <td><strong>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            {{ $transaksis->appends(request()->query())->links('pagination::simple-bootstrap-4') }}
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="fas fa-receipt"></i>
                            <h3>Tidak Ada Transaksi</h3>
                            <p>Belum ada transaksi pada periode yang dipilih.</p>
                        </div>
                        @endif
                    </div>

                    <!-- Top Products -->
                    <div class="report-card">
                        <h3><i class="fas fa-star"></i> Produk Terlaris</h3>

                        @if($produkTerlaris->count() > 0)
                        <div class="top-products">
                            @foreach($produkTerlaris as $index => $produk)
                            <div class="product-item">
                                <div class="product-info">
                                    <h4>{{ $produk->nama }}</h4>
                                    <p>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                                <div class="product-stats">
                                    <div class="quantity">{{ $produk->total_terjual }} terjual</div>
                                    <div class="revenue">Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h3>Belum Ada Data</h3>
                            <p>Data produk terlaris akan muncul setelah ada transaksi.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Export Section -->
                <div class="export-section">
                    <h3><i class="fas fa-download"></i> Export Laporan</h3>
                    <div class="export-buttons">
                        <a href="{{ route('kasir.laporan.export-pdf') }}?{{ http_build_query(request()->query()) }}" class="btn-export pdf">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </a>
                        <a href="{{ route('kasir.laporan.export-excel') }}?{{ http_build_query(request()->query()) }}" class="btn-export excel">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
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

        // Close sidebar on window resize if desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Sales Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const chartData = @json($chartData);

        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(item => item.tanggal),
                datasets: [{
                    label: 'Penjualan Harian',
                    data: chartData.map(item => item.penjualan),
                    borderColor: '#cd4fb8',
                    backgroundColor: 'rgba(205, 79, 184, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#cd4fb8',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#F5F5F5',
                            font: {
                                size: 14,
                                weight: 600
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#b8c5d0',
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: 'rgba(205, 79, 184, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#b8c5d0',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(205, 79, 184, 0.1)'
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#e06dd0',
                        hoverBorderColor: '#ffffff'
                    }
                }
            }
        });
    </script>
</body>
</html>
