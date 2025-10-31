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
    max-width: 1400px;
    margin: 40px auto;
    padding: 0 40px;
}

/* ========================================
   Quick Actions - Action Buttons
   ======================================== */
.quick-actions {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-top: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.quick-actions h2 {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.quick-actions h2 i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.action-btn {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
    text-align: center;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
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
    background: var(--card-bg);
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.product-table thead {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
}

.product-table thead th {
    padding: 16px;
    text-align: left;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.product-table tbody tr {
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
    transition: all 0.3s ease;
}

.product-table tbody tr:hover {
    background: var(--card-hover-bg);
}

.product-table tbody tr:last-child {
    border-bottom: none;
}

.product-table tbody td {
    padding: 16px;
    color: var(--color-text);
    font-size: 14px;
}

.product-table tbody td:first-child {
    font-weight: 600;
    color: var(--color-primary-light);
}

.product-code {
    font-family: 'Courier New', monospace;
    font-weight: 700;
    color: var(--color-primary-light);
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

.btn-toggle-status {
    transition: all 0.3s ease;
}

.btn-toggle-status:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

.btn-toggle-status.activate {
    background: #4CAF50 !important;
}

.btn-toggle-status.activate:hover {
    background: #45a049 !important;
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.btn-toggle-status.deactivate {
    background: #FF9800 !important;
}

.btn-toggle-status.deactivate:hover {
    background: #F57C00 !important;
    box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
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
    color: var(--color-primary);
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
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 700px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
    animation: slideDown 0.3s ease;
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
}

.modal-header h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 600;
}

.modal-header h2 i {
    margin-right: 8px;
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
    max-height: 70vh;
    overflow-y: auto;
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

.form-group label i {
    color: var(--color-primary-light);
    margin-right: 6px;
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
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
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
    background: var(--color-bg);
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
    background: var(--color-bg);
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
    color: var(--color-primary-light);
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
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.pagination-info {
    color: var(--color-text);
    font-size: 14px;
}

.pagination-info strong {
    color: var(--color-primary-light);
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
    background: var(--color-bg);
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
    background: var(--color-bg);
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
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    border-color: var(--color-primary);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.pagination-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.page-numbers {
    display: flex;
    gap: 4px;
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

    .form-row {
        grid-template-columns: 1fr;
    }

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
                    <h2>Data Produk</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <!-- Product Management Section -->
                <div class="quick-actions">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
                        <div>
                            <h2 style="margin: 0; border: none; padding: 0;">
                                <i class="fas fa-box"></i> Data Produk
                            </h2>
                            <p style="color: var(--color-text-muted); font-size: 14px; margin-top: 4px;">Kelola semua produk Anda di sini</p>
                        </div>
                        <div>
                            <button class="action-btn" onclick="openModal()">
                                <i class="fas fa-plus"></i> Tambah Produk
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
                                    <div class="no-image"><i class="fas fa-box"></i></div>
                                @endif
                            </td>
                            <td><span class="product-code">{{ $produk->kode_produk }}</span></td>
                            <td style="font-weight: 600;">{{ $produk->nama_produk }}</td>
                            <td>
                                <span style="background: rgba(205, 79, 184, 0.3); color: var(--color-text); padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
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
                                    <br><small style="color: #4CAF50; font-weight: 500;"><i class="fas fa-tag"></i> Promo Aktif</small>
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
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="toggleStatusProduk({{ $produk->id }})" class="btn-action btn-toggle-status {{ $produk->status == 'aktif' ? 'deactivate' : 'activate' }}">
                                    <i class="fas fa-{{ $produk->status == 'aktif' ? 'eye-slash' : 'eye' }}"></i> {{ $produk->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                                <button onclick="hapusProduk({{ $produk->id }})" class="btn-action btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="empty-state">
                                <div class="empty-state-icon"><i class="fas fa-box-open"></i></div>
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
                            <i class="fas fa-angle-double-left"></i> First
                        </button>
                        <button class="pagination-btn" onclick="goToPage({{ $produks->currentPage() - 1 }})" {{ !$produks->previousPageUrl() ? 'disabled' : '' }}>
                            <i class="fas fa-angle-left"></i> Prev
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
                            Next <i class="fas fa-angle-right"></i>
                        </button>
                        <button class="pagination-btn" onclick="goToPage({{ $produks->lastPage() }})" {{ $produks->currentPage() == $produks->lastPage() ? 'disabled' : '' }}>
                            Last <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah/Edit Produk -->
    <div id="produkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"><i class="fas fa-box"></i> Tambah Produk</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <form id="produkForm">
                @csrf
                <input type="hidden" id="produkId" name="produk_id">
                <input type="hidden" id="formMethod" name="_method" value="POST">

                <div class="modal-body">
                    <!-- Info Kode Produk (hanya tampil saat edit) -->
                    <div class="form-group" id="kodeProdukInfo" style="display: none;">
                        <label><i class="fas fa-barcode"></i> Kode Produk</label>
                        <div style="background: rgba(205, 79, 184, 0.2); padding: 12px 16px; border-radius: 8px; border: 2px solid rgba(205, 79, 184, 0.3);">
                            <span class="product-code" id="displayKodeProduk" style="background: transparent; padding: 0;"></span>
                        </div>
                        <small style="color: var(--color-text-muted); font-size: 12px; margin-top: 4px; display: block;">
                            <i class="fas fa-info-circle"></i> Kode produk dibuat otomatis dan tidak dapat diubah
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="nama_produk"><i class="fas fa-tag"></i> Nama Produk *</label>
                        <input type="text" id="nama_produk" name="nama_produk" required placeholder="Contoh: Indomie Goreng">
                        <span class="error-message" id="error_nama_produk"></span>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi"><i class="fas fa-align-left"></i> Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi produk (opsional)"></textarea>
                        <span class="error-message" id="error_deskripsi"></span>
                    </div>

                    <div class="form-group">
                        <label for="gambar"><i class="fas fa-image"></i> Gambar Produk</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                            <label for="gambar" class="file-input-label">
                                <i class="fas fa-camera"></i> Pilih Gambar
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
                            <label for="kategori"><i class="fas fa-list"></i> Kategori *</label>
                            <input type="text" id="kategori" name="kategori" required placeholder="Contoh: Makanan">
                            <span class="error-message" id="error_kategori"></span>
                        </div>
                        <div class="form-group">
                            <label for="satuan"><i class="fas fa-balance-scale"></i> Satuan *</label>
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
                            <label for="harga_normal"><i class="fas fa-dollar-sign"></i> Harga Normal (Modal) *</label>
                            <input type="number" id="harga_normal" name="harga_normal" required min="0" step="0.01" placeholder="0">
                            <span class="error-message" id="error_harga_normal"></span>
                        </div>
                        <div class="form-group">
                            <label for="harga_untung"><i class="fas fa-money-bill-wave"></i> Harga Jual (Untung) *</label>
                            <input type="number" id="harga_untung" name="harga_untung" required min="0" step="0.01" placeholder="0">
                            <span class="error-message" id="error_harga_untung"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="harga_diskon"><i class="fas fa-percent"></i> Harga Diskon</label>
                            <input type="number" id="harga_diskon" name="harga_diskon" min="0" step="0.01" placeholder="0" readonly>
                            <span class="error-message" id="error_harga_diskon"></span>
                            <small style="color: var(--color-text-muted); font-size: 12px; margin-top: 4px; display: block;">
                                <i class="fas fa-info-circle"></i> Harga diskon akan otomatis terisi jika produk memiliki promo aktif
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="stok"><i class="fas fa-cubes"></i> Stok *</label>
                            <input type="number" id="stok" name="stok" required min="0" placeholder="0">
                            <span class="error-message" id="error_stok"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status"><i class="fas fa-toggle-on"></i> Status *</label>
                        <select id="status" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        <span class="error-message" id="error_status"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
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
            document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle"></i> Tambah Produk';
            document.getElementById('produkForm').reset();
            document.getElementById('produkId').value = '';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('fileName').textContent = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.getElementById('kodeProdukInfo').style.display = 'none';
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

                    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Produk';
                    document.getElementById('produkId').value = produk.id;
                    document.getElementById('formMethod').value = 'PUT';

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
                    // Jika error karena produk sudah digunakan dalam transaksi
                    if (result.suggestion === 'force_delete_with_consequences') {
                        showForceDeleteConfirmation(id, result.message, result.transaction_count);
                    } else {
                        alert(result.message || 'Gagal menghapus produk');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus produk');
            }
        }

        function showForceDeleteConfirmation(id, message, transactionCount) {
            const userChoice = confirm(
                message + '\n\n' +
                '⚠️ APAKAH ANDA YAKIN INGIN TETAP MENGHAPUS?\n\n' +
                'KONSEKUENSI:\n' +
                `• ${transactionCount} data transaksi akan terpengaruh\n` +
                '• Data riwayat transaksi akan menunjukkan "PRODUK DIHAPUS"\n' +
                '• Laporan yang melibatkan produk ini mungkin terganggu\n' +
                '• Aksi ini TIDAK DAPAT DIBATALKAN!\n\n' +
                'Pilih "OK" untuk HAPUS PAKSA atau "Cancel" untuk membatalkan.'
            );

            if (userChoice) {
                forceDeleteProduk(id);
            }
        }

        async function forceDeleteProduk(id) {
            // Konfirmasi terakhir
            const finalConfirm = confirm(
                '🚨 KONFIRMASI TERAKHIR 🚨\n\n' +
                'Anda akan menghapus produk secara PERMANEN!\n' +
                'Data transaksi akan diubah menjadi "PRODUK DIHAPUS".\n\n' +
                'Ketik "HAPUS" di prompt berikutnya untuk konfirmasi:'
            );

            if (!finalConfirm) {
                return;
            }

            const confirmText = prompt('Ketik "HAPUS" (tanpa tanda kutip) untuk konfirmasi penghapusan:');

            if (confirmText !== 'HAPUS') {
                alert('Konfirmasi tidak sesuai. Penghapusan dibatalkan.');
                return;
            }

            try {
                const response = await fetch(`/admin/produk/${id}/force`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('✅ ' + result.message);
                    location.reload();
                } else {
                    alert('❌ ' + (result.message || 'Gagal menghapus produk secara paksa'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat menghapus produk secara paksa');
            }
        }

        async function toggleStatusProduk(id) {
            try {
                const response = await fetch(`/admin/produk/${id}/toggle-status`, {
                    method: 'PATCH',
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
                    alert(result.message || 'Gagal mengubah status produk');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengubah status produk');
            }
        }

        document.getElementById('produkForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

            const formElement = e.target;
            const formData = new FormData(formElement);
            const produkId = document.getElementById('produkId').value;
            const method = document.getElementById('formMethod').value;

            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }

            try {
                const url = produkId ? `/admin/produk/${produkId}` : '/admin/produk';
                const response = await fetch(url, {
                    method: 'POST',
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
                submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan';
            }
        });

        window.onclick = function(event) {
            const modal = document.getElementById('produkModal');
            if (event.target == modal) {
                closeModal();
            }
        }

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
            currentPage = 1;
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
                        <td colspan="11" class="empty-state">
                            <div class="empty-state-icon"><i class="fas fa-box-open"></i></div>
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
                    : `<div class="no-image"><i class="fas fa-box"></i></div>`;

                const statusClass = produk.status === 'aktif' ? 'aktif' : 'nonaktif';
                const statusText = produk.status === 'aktif' ? '✓ Aktif' : '✕ Nonaktif';

                html += `
                    <tr>
                        <td>${no}</td>
                        <td>${gambar}</td>
                        <td><span class="product-code">${produk.kode_produk}</span></td>
                        <td style="font-weight: 600;">${produk.nama_produk}</td>
                        <td>
                            <span style="background: rgba(205, 79, 184, 0.3); color: var(--color-text); padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 500;">
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
                                `<span style="color: #FF5722;">Rp ${formatNumber(produk.harga_diskon)}</span><br><small style="color: #4CAF50; font-weight: 500;"><i class="fas fa-tag"></i> Promo Aktif</small>` :
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
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button onclick="toggleStatusProduk(${produk.id})" class="btn-action btn-toggle-status ${produk.status === 'aktif' ? 'deactivate' : 'activate'}">
                                <i class="fas fa-${produk.status === 'aktif' ? 'eye-slash' : 'eye'}"></i> ${produk.status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan'}
                            </button>
                            <button onclick="hapusProduk(${produk.id})" class="btn-action btn-delete">
                                <i class="fas fa-trash"></i> Hapus
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

            document.getElementById('showingFrom').textContent = data.from || 0;
            document.getElementById('showingTo').textContent = data.to || 0;
            document.getElementById('totalItems').textContent = data.total;

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
            updateNavigationButtons();
        }

        function updateNavigationButtons() {
            const buttons = document.querySelectorAll('.pagination-buttons > .pagination-btn');
            buttons[0].disabled = currentPage === 1;
            buttons[0].onclick = () => goToPage(1);
            buttons[1].disabled = currentPage === 1;
            buttons[1].onclick = () => goToPage(currentPage - 1);
            buttons[buttons.length - 2].disabled = currentPage === lastPage;
            buttons[buttons.length - 2].onclick = () => goToPage(currentPage + 1);
            buttons[buttons.length - 1].disabled = currentPage === lastPage;
            buttons[buttons.length - 1].onclick = () => goToPage(lastPage);
        }

        function formatNumber(num) {
            return parseFloat(num).toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

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
