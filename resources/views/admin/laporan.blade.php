<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - Kasir Yaallah</title>
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
    --danger-color: #ef4444;
    --info-color: #3b82f6;
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
   Sidebar Navigation (sama seperti dashboard)
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
    display: flex;
    flex-direction: column;
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

.sidebar-header h2 i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.sidebar-header p {
    font-size: 14px;
    opacity: 0.8;
    color: var(--color-text-muted);
}

.sidebar-menu {
    padding: 20px 0;
    flex: 1;
    overflow-y: auto;
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
    padding: 20px;
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    background: rgba(15, 35, 50, 0.5);
    margin-top: auto;
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
    max-width: 1400px;
    margin: 40px auto;
    padding: 0 40px;
}

/* ========================================
   Filter Section
   ======================================== */
.filter-section {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.filter-form {
    display: flex;
    gap: 20px;
    align-items: end;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    flex-direction: column;
    min-width: 200px;
}

.form-group label {
    color: var(--color-text);
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 14px;
}

.form-group input {
    padding: 12px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    background: var(--color-bg-alt);
    color: var(--color-text);
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: var(--color-primary);
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
    height: fit-content;
}

.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
}

/* ========================================
   Statistics Overview
   ======================================== */
.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 30px;
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
    background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
    background: var(--card-hover-bg);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.stat-title {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary-light);
    line-height: 1;
}

/* ========================================
   Report Sections
   ======================================== */
.report-section {
    background: var(--card-bg);
    margin-bottom: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
    overflow: hidden;
}

.report-header {
    padding: 20px 30px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
    background: rgba(205, 79, 184, 0.1);
}

.report-header h3 {
    color: var(--color-text);
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.report-header h3 i {
    color: var(--color-primary-light);
}

.report-content {
    padding: 30px;
}

/* ========================================
   Tables
   ======================================== */
.table-responsive {
    overflow-x: auto;
}

.report-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
}

.report-table th,
.report-table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
}

.report-table th {
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.report-table td {
    color: var(--color-text-muted);
    font-size: 14px;
}

.report-table tr:hover {
    background: rgba(205, 79, 184, 0.05);
}

/* ========================================
   Charts Container
   ======================================== */
.chart-container {
    position: relative;
    height: 400px;
    margin: 20px 0;
}

/* ========================================
   Badge Styles
   ======================================== */
.payment-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin: 2px;
}

.payment-badge.cash {
    background: var(--success-color);
    color: white;
}

.payment-badge.transfer {
    background: var(--info-color);
    color: white;
}

.payment-badge.card {
    background: var(--warning-color);
    color: white;
}

/* ========================================
   Alert Styles
   ======================================== */
.alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-info {
    background: rgba(59, 130, 246, 0.1);
    border-left-color: var(--info-color);
    color: var(--color-text);
}

.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    border-left-color: var(--warning-color);
    color: var(--color-text);
}

/* ========================================
   Grid Layout for Kasir Cards
   ======================================== */
.kasir-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 24px;
    margin-top: 20px;
}

.kasir-card {
    background: var(--color-bg-alt);
    padding: 24px;
    border-radius: 12px;
    border: 2px solid rgba(205, 79, 184, 0.2);
    transition: all 0.3s ease;
}

.kasir-card:hover {
    border-color: var(--color-primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(205, 79, 184, 0.3);
}

.kasir-name {
    font-size: 18px;
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 8px;
}

.kasir-email {
    font-size: 14px;
    color: var(--color-text-muted);
    margin-bottom: 16px;
}

.kasir-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

.kasir-stat {
    text-align: center;
}

.kasir-stat-label {
    font-size: 12px;
    color: var(--color-text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.kasir-stat-value {
    font-size: 20px;
    font-weight: 700;
    color: var(--color-primary-light);
}

.payment-methods {
    margin-top: 16px;
}

.payment-methods h5 {
    font-size: 14px;
    color: var(--color-text);
    margin-bottom: 8px;
}

/* ========================================
   Mobile Responsive
   ======================================== */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
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

    .container {
        padding: 0 20px;
        margin: 24px auto;
    }

    .filter-form {
        flex-direction: column;
        gap: 16px;
    }

    .form-group {
        min-width: 100%;
    }

    .stats-overview {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .kasir-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .chart-container {
        height: 300px;
    }
}

/* ========================================
   Loading Animation
   ======================================== */
.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(205, 79, 184, 0.3);
    border-radius: 50%;
    border-top-color: var(--color-primary);
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* ========================================
   Export Buttons
   ======================================== */
.export-buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.btn-export {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
}

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
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cash-register"></i>AeruStore</h2>
                <p>Admin Panel</p>
            </div>

             <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.produk') }}" class="menu-item {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('admin.promo') }}" class="menu-item {{ request()->routeIs('admin.promo*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    <span>Promo</span>
                </a>
                <a href="{{ route('admin.user-management') }}" class="menu-item {{ request()->routeIs('admin.user-management*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </a>
                <a href="{{ route('admin.laporan') }}" class="menu-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
                <a href="#" class="menu-item" onclick="alert('Fitur dalam pengembangan'); return false;">
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
                    <h2><i class="fas fa-chart-bar"></i> Laporan Admin</h2>
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
                    <form action="{{ route('admin.laporan') }}" method="GET" class="filter-form">
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ $tanggalMulai }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $tanggalSelesai }}">
                        </div>
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </form>
                </div>

                <!-- Export Buttons -->
                <div class="export-buttons">
                    <a href="{{ route('admin.laporan.export.pdf') }}?tanggal_mulai={{ $tanggalMulai }}&tanggal_selesai={{ $tanggalSelesai }}" class="btn-export">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('admin.laporan.export.excel') }}?tanggal_mulai={{ $tanggalMulai }}&tanggal_selesai={{ $tanggalSelesai }}" class="btn-export">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>

                <!-- Statistics Overview -->
                <div class="stats-overview">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total Transaksi</div>
                            <div class="stat-icon">
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($statistikUmum['total_transaksi']) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Total Pendapatan</div>
                            <div class="stat-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="stat-value">Rp {{ number_format($statistikUmum['total_pendapatan'], 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Produk Terjual</div>
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($statistikUmum['total_produk_terjual']) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-title">Rata-rata Transaksi</div>
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                        <div class="stat-value">Rp {{ number_format($statistikUmum['rata_rata_transaksi'], 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Laporan Transaksi Harian -->
                <div class="report-section">
                    <div class="report-header">
                        <h3><i class="fas fa-chart-area"></i> Grafik Transaksi Harian</h3>
                    </div>
                    <div class="report-content">
                        <div class="chart-container">
                            <canvas id="transaksiChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Laporan Per Kasir -->
                <div class="report-section">
                    <div class="report-header">
                        <h3><i class="fas fa-users"></i> Laporan Per Kasir</h3>
                    </div>
                    <div class="report-content">
                        @if($laporanKasir->count() > 0)
                            <div class="kasir-grid">
                                @foreach($laporanKasir as $kasir)
                                <div class="kasir-card">
                                    <div class="kasir-name">{{ $kasir['nama'] }}</div>
                                    <div class="kasir-email">{{ $kasir['email'] }}</div>

                                    <div class="kasir-stats">
                                        <div class="kasir-stat">
                                            <div class="kasir-stat-label">Transaksi</div>
                                            <div class="kasir-stat-value">{{ $kasir['jumlah_transaksi'] }}</div>
                                        </div>
                                        <div class="kasir-stat">
                                            <div class="kasir-stat-label">Total Penjualan</div>
                                            <div class="kasir-stat-value">Rp {{ number_format($kasir['total_penjualan'], 0, ',', '.') }}</div>
                                        </div>
                                    </div>

                                    <div class="payment-methods">
                                        <h5>Metode Pembayaran:</h5>
                                        @if(count($kasir['metode_pembayaran']) > 0)
                                            @foreach($kasir['metode_pembayaran'] as $metode => $jumlah)
                                                <span class="payment-badge {{ strtolower($metode) }}">
                                                    {{ ucfirst($metode) }}: {{ $jumlah }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="payment-badge">Belum ada transaksi</span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Belum ada kasir yang terdaftar dalam sistem.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Laporan Metode Pembayaran -->
                <div class="report-section">
                    <div class="report-header">
                        <h3><i class="fas fa-credit-card"></i> Laporan Metode Pembayaran</h3>
                    </div>
                    <div class="report-content">
                        @if($laporanPembayaran->count() > 0)
                            <div class="table-responsive">
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Metode Pembayaran</th>
                                            <th>Jumlah Transaksi</th>
                                            <th>Total Amount</th>
                                            <th>Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($laporanPembayaran as $pembayaran)
                                        <tr>
                                            <td>
                                                <span class="payment-badge {{ strtolower($pembayaran->payment_method) }}">
                                                    {{ ucfirst($pembayaran->payment_method) }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($pembayaran->jumlah_transaksi) }}</td>
                                            <td>Rp {{ number_format($pembayaran->total_amount, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $persentase = $statistikUmum['total_pendapatan'] > 0
                                                        ? ($pembayaran->total_amount / $statistikUmum['total_pendapatan']) * 100
                                                        : 0;
                                                @endphp
                                                {{ number_format($persentase, 1) }}%
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Belum ada transaksi dalam periode yang dipilih.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Laporan Produk -->
                <div class="report-section">
                    <div class="report-header">
                        <h3><i class="fas fa-box"></i> Laporan Produk</h3>
                    </div>
                    <div class="report-content">
                        <div class="stats-overview" style="margin-bottom: 20px;">
                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-title">Total Produk Aktif</div>
                                    <div class="stat-icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <div class="stat-value">{{ number_format($laporanProduk['total_produk_aktif']) }}</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-header">
                                    <div class="stat-title">Produk Tanpa Stok</div>
                                    <div class="stat-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div class="stat-value">{{ number_format($laporanProduk['produk_tanpa_stok']) }}</div>
                            </div>
                        </div>

                        <h4 style="color: var(--color-text); margin-bottom: 16px;">Top 10 Produk Terlaris</h4>
                        @if($laporanProduk['produk_terlaris']->count() > 0)
                            <div class="table-responsive">
                                <table class="report-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Total Terjual</th>
                                            <th>Total Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($laporanProduk['produk_terlaris'] as $produk)
                                        <tr>
                                            <td>{{ $produk->produk->nama ?? 'Produk Terhapus' }}</td>
                                            <td>{{ $produk->produk->kategori ?? '-' }}</td>
                                            <td>Rp {{ number_format($produk->produk->harga ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ number_format($produk->total_terjual) }}</td>
                                            <td>Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Belum ada produk yang terjual dalam periode yang dipilih.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar Toggle for Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle && sidebar && sidebarOverlay) {
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
            }

            // Chart untuk Transaksi Harian
            const ctx = document.getElementById('transaksiChart').getContext('2d');
            const transaksiData = @json($transaksiHarian);

            const labels = transaksiData.map(item => {
                const date = new Date(item.tanggal);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short'
                });
            });

            const jumlahTransaksi = transaksiData.map(item => item.jumlah_transaksi);
            const totalPenjualan = transaksiData.map(item => item.total_penjualan);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: jumlahTransaksi,
                        borderColor: '#cd4fb8',
                        backgroundColor: 'rgba(205, 79, 184, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y'
                    }, {
                        label: 'Total Penjualan (Rp)',
                        data: totalPenjualan,
                        borderColor: '#FFE900',
                        backgroundColor: 'rgba(255, 233, 0, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#F5F5F5'
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#b8c5d0'
                            },
                            grid: {
                                color: 'rgba(205, 79, 184, 0.2)'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            ticks: {
                                color: '#b8c5d0'
                            },
                            grid: {
                                color: 'rgba(205, 79, 184, 0.2)'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            ticks: {
                                color: '#b8c5d0',
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
