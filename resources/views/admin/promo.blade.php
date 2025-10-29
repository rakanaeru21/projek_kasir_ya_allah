{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\admin\promo.blade.php --}}
@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Promo[] $promos */
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Produk[] $produks */
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Promo - Kasir Yaallah</title>
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
   Page Header
   ======================================== */
.page-header {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border-left: 6px solid var(--color-primary);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.page-header h1 {
    color: var(--color-text);
    font-size: 28px;
    font-weight: 600;
    margin: 0;
}

.page-header p {
    color: var(--color-text-muted);
    margin: 8px 0 0 0;
    font-size: 16px;
}

.btn-add {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.3);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.4);
}

/* ========================================
   Table Styles
   ======================================== */
.table-wrapper {
    background: var(--card-bg);
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.table-header {
    padding: 20px 30px;
    border-bottom: 2px solid rgba(205, 79, 184, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-header h2 {
    color: var(--color-text);
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

.promo-table {
    width: 100%;
    border-collapse: collapse;
}

.promo-table thead {
    background: var(--color-primary);
}

.promo-table thead th {
    padding: 16px;
    text-align: left;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.promo-table tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.promo-table tbody tr:hover {
    background: var(--card-hover-bg);
}

.promo-table tbody tr:last-child {
    border-bottom: none;
}

.promo-table tbody td {
    padding: 16px;
    color: #F5F5F5;
    font-size: 14px;
    vertical-align: top;
}

.promo-name {
    font-weight: 600;
    color: var(--color-primary);
}

.promo-discount {
    font-weight: 700;
    color: var(--color-secondary);
    font-size: 16px;
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

.status-berakhir {
    background: #f44336;
    color: white;
}

.status-akan-datang {
    background: #FF9800;
    color: white;
}

.product-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    max-width: 250px;
}

.product-tag {
    background: rgba(205, 79, 184, 0.2);
    color: var(--color-primary);
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    border: 1px solid rgba(205, 79, 184, 0.3);
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
    background-color: var(--card-bg);
    margin: 2% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    animation: slideDown 0.3s ease;
    max-height: 90vh;
    overflow-y: auto;
    border: 1px solid rgba(205, 79, 184, 0.2);
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
    position: sticky;
    top: 0;
    z-index: 1001;
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
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    background: var(--color-bg);
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

.product-selection {
    margin-top: 20px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 12px;
    max-height: 300px;
    overflow-y: auto;
    padding: 16px;
    background: var(--color-bg);
    border-radius: 8px;
    border: 2px solid rgba(205, 79, 184, 0.2);
}

.product-item {
    background: rgba(205, 79, 184, 0.1);
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    padding: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
}

.product-item:hover {
    background: rgba(205, 79, 184, 0.2);
    border-color: var(--color-primary);
}

.product-item.selected {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: white;
}

.product-checkbox {
    margin-right: 8px;
}

.product-info {
    flex: 1;
}

.product-info .name {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
}

.product-info .code {
    font-size: 12px;
    opacity: 0.8;
    font-family: monospace;
}

.modal-footer {
    padding: 20px 30px;
    border-top: 2px solid rgba(205, 79, 184, 0.2);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    position: sticky;
    bottom: 0;
    background: var(--card-bg);
    border-radius: 0 0 12px 12px;
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
   Alert Styles
   ======================================== */
.alert {
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid;
    display: none;
}

.alert-success {
    background: rgba(76, 175, 80, 0.1);
    border-color: #4CAF50;
    color: #4CAF50;
}

.alert-error {
    background: rgba(244, 67, 54, 0.1);
    border-color: #f44336;
    color: #f44336;
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

    .page-header {
        padding: 20px;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .promo-table {
        font-size: 12px;
    }

    .promo-table th,
    .promo-table td {
        padding: 12px 8px;
    }

    .product-tags {
        max-width: 150px;
    }
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cash-register"></i> AeruStore</h2>
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
                <a href="#" class="menu-item" onclick="alert('Fitur dalam pengembangan'); return false;">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </a>
                <a href="#" class="menu-item" onclick="alert('Fitur dalam pengembangan'); return false;">
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
                    <h2>Data Promo</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1><i class="fas fa-tags"></i> Kelola Promo</h1>
                        <p>Tambah, edit, dan kelola promo diskon untuk produk</p>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <button class="btn-add" onclick="openModal()"><i class="fas fa-plus"></i> Tambah Promo</button>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div id="alertSuccess" class="alert alert-success"></div>
                <div id="alertError" class="alert alert-error"></div>

                <!-- Tabel Promo -->
                <div class="table-wrapper">
                    <div class="table-header">
                        <h2>Daftar Promo</h2>
                        <span>Total: {{ count($promos) }} promo</span>
                    </div>

                @if(count($promos) > 0)
                    <table class="promo-table">
                        <thead>
                            <tr>
                                <th>Nama Promo</th>
                                <th>Diskon</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Produk Terkait</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promos as $promo)
                                <tr>
                                    <td>
                                        <div class="promo-name">{{ $promo->nama }}</div>
                                        @if($promo->deskripsi)
                                            <div style="font-size: 12px; color: #ccc; margin-top: 4px;">
                                                {{ Str::limit($promo->deskripsi, 50) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="promo-discount">{{ number_format((float)$promo->diskon, 0) }}%</span>
                                    </td>
                                    <td>
                                        <div>{{ date('d/m/Y', strtotime($promo->mulai)) }}</div>
                                        <div style="font-size: 12px; color: #ccc;">s/d {{ date('d/m/Y', strtotime($promo->berakhir)) }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $today = now()->toDateString();
                                            if ($promo->berakhir < $today) {
                                                $status = 'berakhir';
                                                $statusText = 'Berakhir';
                                            } elseif ($promo->mulai > $today) {
                                                $status = 'akan-datang';
                                                $statusText = 'Akan Datang';
                                            } else {
                                                $status = 'aktif';
                                                $statusText = 'Aktif';
                                            }
                                        @endphp
                                        <span class="status-badge status-{{ $status }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        <div class="product-tags">
                                            @forelse($promo->produks->take(3) as $produk)
                                                <span class="product-tag">{{ $produk->nama_produk }}</span>
                                            @empty
                                                <span style="color: #ccc; font-style: italic;">Tidak ada produk</span>
                                            @endforelse
                                            @if($promo->produks->count() > 3)
                                                <span class="product-tag">+{{ $promo->produks->count() - 3 }} lainnya</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn-action btn-edit" onclick="editPromo({{ $promo->id }})">Edit</button>
                                        <button class="btn-action btn-delete" onclick="deletePromo({{ $promo->id }}, '{{ $promo->nama }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="fas fa-tags"></i></div>
                        <div class="empty-state-text">Belum ada promo yang dibuat</div>
                    </div>
                @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah/Edit Promo -->
    <div id="promoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Tambah Promo Baru</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="promoForm">
                    <input type="hidden" id="promoId" name="promo_id" value="">

                    <div class="form-group">
                        <label for="nama">Nama Promo *</label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: Flash Sale Weekend" required>
                        <div class="error-message" id="errorNama"></div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi promo (opsional)"></textarea>
                        <div class="error-message" id="errorDeskripsi"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="diskon">Diskon (%) *</label>
                            <input type="number" id="diskon" name="diskon" min="0" max="100" step="0.01" placeholder="0" required>
                            <div class="error-message" id="errorDiskon"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="mulai">Tanggal Mulai *</label>
                            <input type="date" id="mulai" name="mulai" required>
                            <div class="error-message" id="errorMulai"></div>
                        </div>
                        <div class="form-group">
                            <label for="berakhir">Tanggal Berakhir *</label>
                            <input type="date" id="berakhir" name="berakhir" required>
                            <div class="error-message" id="errorBerakhir"></div>
                        </div>
                    </div>

                    <div class="product-selection">
                        <label>Pilih Produk yang Akan Dipromo *</label>
                        <div class="product-grid" id="productGrid">
                            @foreach($produks as $produk)
                                <div class="product-item" onclick="toggleProduct({{ $produk->id }})">
                                    <input type="checkbox" class="product-checkbox" name="produk_ids[]" value="{{ $produk->id }}" id="produk_{{ $produk->id }}">
                                    <div class="product-info">
                                        <div class="name">{{ $produk->nama_produk }}</div>
                                        <div class="code">{{ $produk->kode_produk }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="error-message" id="errorProdukIds"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" form="promoForm" class="btn-submit" id="submitBtn">Simpan Promo</button>
            </div>
        </div>
    </div>

    <script>
        // Variables
        let isEditMode = false;
        let currentPromoId = null;

        // Modal functions
        function openModal(mode = 'create') {
            const modal = document.getElementById('promoModal');
            const modalTitle = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('submitBtn');

            if (mode === 'create') {
                modalTitle.textContent = 'Tambah Promo Baru';
                submitBtn.textContent = 'Simpan Promo';
                document.getElementById('promoForm').reset();
                document.getElementById('promoId').value = '';
                clearErrors();
                clearProductSelection();
                isEditMode = false;
            }

            modal.style.display = 'block';

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('mulai').setAttribute('min', today);
            document.getElementById('berakhir').setAttribute('min', today);
        }

        function closeModal() {
            const modal = document.getElementById('promoModal');
            modal.style.display = 'none';
            clearErrors();
        }

        // Product selection functions
        function toggleProduct(produkId) {
            const checkbox = document.getElementById(`produk_${produkId}`);
            const productItem = checkbox.closest('.product-item');

            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                productItem.classList.add('selected');
            } else {
                productItem.classList.remove('selected');
            }
        }

        function clearProductSelection() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                checkbox.closest('.product-item').classList.remove('selected');
            });
        }

        // Form validation and error handling
        function clearErrors() {
            document.querySelectorAll('.form-group').forEach(group => {
                group.classList.remove('error');
            });
            document.querySelectorAll('.error-message').forEach(error => {
                error.style.display = 'none';
                error.textContent = '';
            });
        }

        function showError(field, message) {
            const errorElement = document.getElementById(`error${field.charAt(0).toUpperCase() + field.slice(1)}`);
            const formGroup = errorElement.closest('.form-group');

            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                formGroup.classList.add('error');
            }
        }

        // Alert functions
        function showAlert(type, message) {
            const alertElement = document.getElementById(`alert${type.charAt(0).toUpperCase() + type.slice(1)}`);
            alertElement.textContent = message;
            alertElement.style.display = 'block';

            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 5000);
        }

        // CRUD Operations
        function editPromo(promoId) {
            fetch(`/admin/promo/${promoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const promo = data.data;

                        // Fill form with existing data
                        document.getElementById('promoId').value = promo.id;
                        document.getElementById('nama').value = promo.nama;
                        document.getElementById('deskripsi').value = promo.deskripsi || '';
                        document.getElementById('diskon').value = promo.diskon;
                        document.getElementById('mulai').value = promo.mulai;
                        document.getElementById('berakhir').value = promo.berakhir;

                        // Clear and set product selection
                        clearProductSelection();
                        promo.produks.forEach(produk => {
                            const checkbox = document.getElementById(`produk_${produk.id}`);
                            if (checkbox) {
                                checkbox.checked = true;
                                checkbox.closest('.product-item').classList.add('selected');
                            }
                        });

                        // Update modal for edit mode
                        document.getElementById('modalTitle').textContent = 'Edit Promo';
                        document.getElementById('submitBtn').textContent = 'Update Promo';
                        isEditMode = true;
                        currentPromoId = promoId;

                        openModal('edit');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Gagal mengambil data promo');
                });
        }

        function deletePromo(promoId, promoName) {
            if (confirm(`Apakah Anda yakin ingin menghapus promo "${promoName}"?`)) {
                fetch(`/admin/promo/${promoId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Terjadi kesalahan saat menghapus promo');
                });
            }
        }

        // Form submission
        document.getElementById('promoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            clearErrors();

            // Validate product selection
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            console.log('Selected products:', selectedProducts.length);

            if (selectedProducts.length === 0) {
                showError('produkIds', 'Pilih minimal 1 produk');
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Menyimpan...';

            // Create form data manually
            const data = {
                nama: document.getElementById('nama').value,
                deskripsi: document.getElementById('deskripsi').value,
                diskon: document.getElementById('diskon').value,
                mulai: document.getElementById('mulai').value,
                berakhir: document.getElementById('berakhir').value,
                produk_ids: Array.from(selectedProducts).map(cb => cb.value)
            };

            console.log('Form data:', data);

            const url = isEditMode ? `/admin/promo/${currentPromoId}` : '/admin/promo';
            const method = isEditMode ? 'PUT' : 'POST';

            // Add method for Laravel
            if (isEditMode) {
                data._method = 'PUT';
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    closeModal();
                    showAlert('success', data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const fieldName = field.replace('_', '').replace('.', '');
                            showError(fieldName, data.errors[field][0] || data.errors[field]);
                        });
                    } else {
                        showAlert('error', data.message || 'Terjadi kesalahan');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat menyimpan promo');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });

        // Date validation
        document.getElementById('mulai').addEventListener('change', function() {
            const berakhirInput = document.getElementById('berakhir');
            berakhirInput.setAttribute('min', this.value);

            if (berakhirInput.value && berakhirInput.value < this.value) {
                berakhirInput.value = this.value;
            }
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('promoModal');
            if (event.target === modal) {
                closeModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set default dates if creating new promo
            if (!isEditMode) {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('mulai').value = today;

                const nextWeek = new Date();
                nextWeek.setDate(nextWeek.getDate() + 7);
                document.getElementById('berakhir').value = nextWeek.toISOString().split('T')[0];
            }
        });

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
        });
    </script>
</body>
</html>
