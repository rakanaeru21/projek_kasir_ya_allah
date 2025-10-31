<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Kasir Yaallah</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    --success-color: #4CAF50;
    --warning-color: #FF9800;
    --danger-color: #f44336;
    --info-color: #2196F3;
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

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1400px;
    margin: 40px auto;
    padding: 0 40px;
}

/* ========================================
   Stats Grid - Dashboard Statistics
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    border-bottom: 4px solid var(--color-primary);
    border: 1px solid rgba(205, 79, 184, 0.2);
    text-align: center;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
}

.stat-card h3 {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: var(--color-primary-light);
    line-height: 1;
}

/* ========================================
   Filters & Search Section
   ======================================== */
.filters-section {
    background: var(--card-bg);
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.filters-header {
    color: var(--color-text);
    margin-bottom: 20px;
    font-size: 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.filter-group select,
.filter-group input {
    background: var(--color-bg-alt);
    border: 2px solid rgba(205, 79, 184, 0.3);
    color: var(--color-text);
    padding: 12px;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.filter-group select:focus,
.filter-group input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.2);
}

.filter-group option {
    background: var(--color-bg-alt);
    color: var(--color-text);
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
    display: flex;
    align-items: center;
    gap: 8px;
    height: fit-content;
}

.btn-filter:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
}

.btn-clear {
    background: var(--color-bg-alt);
    color: var(--color-text-muted);
    padding: 12px 24px;
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    height: fit-content;
}

.btn-clear:hover {
    border-color: var(--color-primary);
    color: var(--color-text);
}

/* ========================================
   User Management Table
   ======================================== */
.users-section {
    background: var(--card-bg);
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
    overflow: hidden;
}

.users-header {
    padding: 24px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
    background: rgba(205, 79, 184, 0.1);
}

.users-header h2 {
    color: var(--color-text);
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.table-container {
    overflow-x: auto;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th,
.users-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
}

.users-table th {
    background: var(--color-bg-alt);
    color: var(--color-text-muted);
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.users-table td {
    color: var(--color-text);
}

.users-table tr:hover {
    background: rgba(205, 79, 184, 0.1);
}

/* User Avatar in table */
.user-avatar-small {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 12px;
    margin-right: 12px;
}

.user-info-cell {
    display: flex;
    align-items: center;
}

.user-name {
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 4px;
}

.user-email {
    font-size: 12px;
    color: var(--color-text-muted);
}

/* Role Badges */
.role-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-admin {
    background: linear-gradient(135deg, var(--danger-color) 0%, #ff6b6b 100%);
    color: white;
}

.role-kasir {
    background: linear-gradient(135deg, var(--warning-color) 0%, #ffb74d 100%);
    color: white;
}

.role-pengguna {
    background: linear-gradient(135deg, var(--info-color) 0%, #64b5f6 100%);
    color: white;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: linear-gradient(135deg, var(--success-color) 0%, #81c784 100%);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #666 0%, #999 100%);
    color: white;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-action {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 4px;
}

.btn-edit {
    background: linear-gradient(135deg, var(--info-color) 0%, #64b5f6 100%);
    color: white;
}

.btn-edit:hover {
    background: linear-gradient(135deg, #1976d2 0%, var(--info-color) 100%);
    transform: translateY(-2px);
}

.btn-toggle {
    background: linear-gradient(135deg, var(--warning-color) 0%, #ffb74d 100%);
    color: white;
}

.btn-toggle:hover {
    background: linear-gradient(135deg, #f57c00 0%, var(--warning-color) 100%);
    transform: translateY(-2px);
}

.btn-view {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
}

.btn-view:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
}

/* ========================================
   Modal Styles
   ======================================== */
.modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    background: var(--card-bg);
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(205, 79, 184, 0.2);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
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
    padding: 24px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(205, 79, 184, 0.1);
    border-radius: 12px 12px 0 0;
}

.modal-header h3 {
    color: var(--color-text);
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.close {
    color: var(--color-text-muted);
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close:hover {
    color: var(--color-primary-light);
}

.modal-body {
    padding: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.form-group select {
    width: 100%;
    background: var(--color-bg-alt);
    border: 2px solid rgba(205, 79, 184, 0.3);
    color: var(--color-text);
    padding: 12px;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-group select:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.2);
}

.modal-footer {
    padding: 24px;
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

.btn-modal {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
}

.btn-secondary {
    background: var(--color-bg-alt);
    color: var(--color-text-muted);
    border: 2px solid rgba(205, 79, 184, 0.3);
}

.btn-secondary:hover {
    border-color: var(--color-primary);
    color: var(--color-text);
}

/* ========================================
   Pagination
   ======================================== */
.pagination-container {
    padding: 24px;
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    background: var(--color-bg-alt);
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.pagination a,
.pagination span {
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    color: var(--color-text-muted);
    border: 2px solid rgba(205, 79, 184, 0.3);
    background: var(--card-bg);
    transition: all 0.3s ease;
}

.pagination a:hover {
    border-color: var(--color-primary);
    color: var(--color-text);
    transform: translateY(-2px);
}

.pagination .active span {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    border-color: var(--color-primary);
}

/* ========================================
   Alert Messages
   ======================================== */
.alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 4px solid;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-success {
    background: rgba(76, 175, 80, 0.2);
    border-left-color: var(--success-color);
    color: #81c784;
}

.alert-danger {
    background: rgba(244, 67, 54, 0.2);
    border-left-color: var(--danger-color);
    color: #ef5350;
}

.alert-warning {
    background: rgba(255, 152, 0, 0.2);
    border-left-color: var(--warning-color);
    color: #ffb74d;
}

/* ========================================
   Loading Spinner
   ======================================== */
.loading {
    display: none;
    text-align: center;
    padding: 40px;
    color: var(--color-text-muted);
}

.spinner {
    border: 4px solid rgba(205, 79, 184, 0.3);
    border-top: 4px solid var(--color-primary);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 16px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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
    color: var(--color-primary);
    margin-bottom: 16px;
}

.empty-state h3 {
    font-size: 18px;
    margin-bottom: 8px;
    color: var(--color-text);
}

.empty-state p {
    font-size: 14px;
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

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .filters-grid {
        grid-template-columns: 1fr;
    }

    .table-container {
        overflow-x: scroll;
    }

    .users-table {
        min-width: 800px;
    }

    .modal-content {
        width: 95%;
        margin: 10% auto;
    }

    .action-buttons {
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .modal-footer {
        flex-direction: column;
    }

    .btn-modal {
        width: 100%;
    }
}

/* ========================================
   Sidebar Overlay for Mobile
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

.sidebar-overlay.active {
    display: block;
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
                <a href="{{ route('kasir.aerucoin.requests') }}" class="menu-item {{ request()->routeIs('kasir.aerucoin.requests*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Request AeruCoin</span>
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
                    <h2>User Management</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <!-- Alert Messages -->
                <div id="alertContainer"></div>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Users</h3>
                        <div class="stat-number">{{ $totalUsers }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Admin</h3>
                        <div class="stat-number">{{ $adminCount }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Kasir</h3>
                        <div class="stat-number">{{ $kasirCount }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Pengguna</h3>
                        <div class="stat-number">{{ $penggunaCount }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Active</h3>
                        <div class="stat-number">{{ $activeUsers }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Inactive</h3>
                        <div class="stat-number">{{ $inactiveUsers }}</div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="filters-section">
                    <h3 class="filters-header">
                        <i class="fas fa-filter"></i>
                        Filter & Search
                    </h3>
                    <form method="GET" action="{{ route('admin.user-management') }}">
                        <div class="filters-grid">
                            <div class="filter-group">
                                <label for="role">Filter by Role</label>
                                <select name="role" id="role">
                                    <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="kasir" {{ request('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    <option value="pengguna" {{ request('role') == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="status">Filter by Status</label>
                                <select name="status" id="status">
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="search">Search Users</label>
                                <input type="text" name="search" id="search" placeholder="Name, email, or phone..." value="{{ request('search') }}">
                            </div>
                            <div class="filter-group">
                                <button type="submit" class="btn-filter">
                                    <i class="fas fa-search"></i>
                                    Apply Filters
                                </button>
                            </div>
                            <div class="filter-group">
                                <a href="{{ route('admin.user-management') }}" class="btn-clear">
                                    <i class="fas fa-times"></i>
                                    Clear Filters
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Users Table -->
                <div class="users-section">
                    <div class="users-header">
                        <h2>
                            <i class="fas fa-users"></i>
                            Users List ({{ $users->total() }} users)
                        </h2>
                    </div>

                    @if($users->count() > 0)
                        <div class="table-container">
                            <table class="users-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="user-info-cell">
                                                    <div class="user-avatar-small">
                                                        {{ substr($user->nama, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="user-name">{{ $user->nama }}</div>
                                                        <div class="user-email">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>{{ $user->nomor_telepon }}</div>
                                                <div class="user-email">{{ $user->email }}</div>
                                            </td>
                                            <td>
                                                <span class="role-badge role-{{ $user->role }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div>{{ $user->created_at->format('d/m/Y') }}</div>
                                                <div class="user-email">{{ $user->created_at->format('H:i') }}</div>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn-action btn-view" onclick="viewUser({{ $user->id }})" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($user->id !== auth()->id())
                                                        <button class="btn-action btn-edit" onclick="editUserRole({{ $user->id }}, '{{ $user->role }}')" title="Change Role">
                                                            <i class="fas fa-user-edit"></i>
                                                        </button>
                                                        <button class="btn-action btn-toggle" onclick="toggleUserStatus({{ $user->id }}, {{ $user->is_active ? 'true' : 'false' }})" title="{{ $user->is_active ? 'Deactivate' : 'Activate' }}">
                                                            <i class="fas fa-{{ $user->is_active ? 'user-slash' : 'user-check' }}"></i>
                                                        </button>
                                                    @else
                                                        <span class="btn-action" style="background: #666; cursor: not-allowed;" title="Cannot modify yourself">
                                                            <i class="fas fa-lock"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h3>No users found</h3>
                            <p>No users match your current filter criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Role Modal -->
    <div id="editRoleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Change User Role</h3>
                <span class="close" onclick="closeModal('editRoleModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editRoleForm">
                    <div class="form-group">
                        <label for="newRole">Select New Role:</label>
                        <select id="newRole" name="role" required>
                            <option value="">Choose a role...</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="pengguna">Pengguna</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-secondary" onclick="closeModal('editRoleModal')">Cancel</button>
                <button type="button" class="btn-modal btn-primary" onclick="saveRoleChange()">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div id="viewUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>User Details</h3>
                <span class="close" onclick="closeModal('viewUserModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div id="userDetails">
                    <!-- User details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-secondary" onclick="closeModal('viewUserModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading" id="loadingOverlay">
        <div class="spinner"></div>
        <p>Processing...</p>
    </div>

    <script>
        // Set up CSRF token for AJAX requests
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Configure AJAX defaults
            window.csrfToken = csrfToken;

            // Sidebar functionality
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    sidebarOverlay.classList.toggle('active');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }

            // Close sidebar on window resize if desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });

        // Global variables
        let currentEditUserId = null;

        // Show alert message
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'}"></i>
                ${message}
            `;

            alertContainer.appendChild(alertDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);

            // Scroll to top to show alert
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Show loading overlay
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'block';
        }

        // Hide loading overlay
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Open modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        // Close modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'editRoleModal') {
                currentEditUserId = null;
                document.getElementById('editRoleForm').reset();
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }

        // Edit user role
        function editUserRole(userId, currentRole) {
            currentEditUserId = userId;
            document.getElementById('newRole').value = currentRole;
            openModal('editRoleModal');
        }

        // Save role change
        function saveRoleChange() {
            if (!currentEditUserId) {
                showAlert('Invalid user ID', 'danger');
                return;
            }

            const newRole = document.getElementById('newRole').value;
            if (!newRole) {
                showAlert('Please select a role', 'warning');
                return;
            }

            showLoading();

            fetch(`/admin/user-management/${currentEditUserId}/role`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({
                    role: newRole
                })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showAlert(data.message, 'success');
                    closeModal('editRoleModal');
                    // Reload page to reflect changes
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showAlert(data.message, 'danger');
                }
            })
            .catch(error => {
                hideLoading();
                showAlert('An error occurred while updating user role', 'danger');
                console.error('Error:', error);
            });
        }

        // Toggle user status
        function toggleUserStatus(userId, currentStatus) {
            const action = currentStatus ? 'deactivate' : 'activate';

            if (!confirm(`Are you sure you want to ${action} this user?`)) {
                return;
            }

            showLoading();

            fetch(`/admin/user-management/${userId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showAlert(data.message, 'success');
                    // Reload page to reflect changes
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showAlert(data.message, 'danger');
                }
            })
            .catch(error => {
                hideLoading();
                showAlert('An error occurred while updating user status', 'danger');
                console.error('Error:', error);
            });
        }

        // View user details
        function viewUser(userId) {
            showLoading();

            fetch(`/admin/user-management/${userId}`)
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    const user = data.user;
                    document.getElementById('userDetails').innerHTML = `
                        <div style="display: grid; gap: 16px;">
                            <div style="display: flex; align-items: center; gap: 16px; padding: 16px; background: var(--color-bg-alt); border-radius: 8px;">
                                <div class="user-avatar" style="width: 60px; height: 60px; font-size: 24px;">
                                    ${user.nama.charAt(0)}
                                </div>
                                <div>
                                    <h3 style="color: var(--color-text); margin-bottom: 4px;">${user.nama}</h3>
                                    <p style="color: var(--color-text-muted);">${user.email}</p>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                                <div>
                                    <label style="color: var(--color-text-muted); font-size: 12px; text-transform: uppercase;">Phone Number</label>
                                    <p style="color: var(--color-text); font-weight: 600;">${user.nomor_telepon}</p>
                                </div>
                                <div>
                                    <label style="color: var(--color-text-muted); font-size: 12px; text-transform: uppercase;">Role</label>
                                    <p><span class="role-badge role-${user.role}">${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</span></p>
                                </div>
                                <div>
                                    <label style="color: var(--color-text-muted); font-size: 12px; text-transform: uppercase;">Status</label>
                                    <p><span class="status-badge ${user.is_active ? 'status-active' : 'status-inactive'}">${user.is_active ? 'Active' : 'Inactive'}</span></p>
                                </div>
                                <div>
                                    <label style="color: var(--color-text-muted); font-size: 12px; text-transform: uppercase;">Joined</label>
                                    <p style="color: var(--color-text); font-weight: 600;">${user.created_at}</p>
                                </div>
                                <div>
                                    <label style="color: var(--color-text-muted); font-size: 12px; text-transform: uppercase;">Last Updated</label>
                                    <p style="color: var(--color-text); font-weight: 600;">${user.updated_at}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    openModal('viewUserModal');
                } else {
                    showAlert(data.message, 'danger');
                }
            })
            .catch(error => {
                hideLoading();
                showAlert('An error occurred while loading user details', 'danger');
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
