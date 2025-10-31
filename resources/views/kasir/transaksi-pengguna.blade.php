<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pengguna - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #cd4fb8;
            --color-primary-light: #e06dd0;
            --color-primary-dark: #b3329d;
            --color-secondary: #FFE900;
            --color-bg: #1B3C53;
            --color-bg-alt: #152e42;
            --color-text: #F5F5F5;
            --color-text-muted: #b8c5d0;
            --sidebar-width: 280px;
            --card-bg: #234a65;
            --card-hover-bg: #2a5672;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-error: #ef4444;
        }

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

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .menu-item i {
            font-size: 18px;
            margin-right: 16px;
            width: 24px;
            text-align: center;
            color: var(--color-text-muted);
            transition: color 0.3s ease;
        }

        .menu-item:hover i,
        .menu-item.active i {
            color: var(--color-primary);
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

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--color-bg-alt);
        }

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

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 40px;
        }

        /* Page Header */
        .page-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--color-text-muted);
            font-size: 16px;
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--color-primary-light);
        }

        .stat-label {
            font-size: 14px;
            color: var(--color-text-muted);
            margin-top: 4px;
        }

        /* Transaksi Table */
        .transaksi-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(205, 79, 184, 0.2);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-text);
        }

        .filter-controls {
            display: flex;
            gap: 10px;
        }

        .filter-select {
            background: var(--color-bg-alt);
            color: var(--color-text);
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        /* Transaksi Cards */
        .transaksi-grid {
            display: grid;
            gap: 20px;
        }

        .transaksi-card {
            background: var(--color-bg-alt);
            border-radius: 12px;
            padding: 20px;
            border: 2px solid rgba(205, 79, 184, 0.2);
            transition: all 0.3s ease;
        }

        .transaksi-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(205, 79, 184, 0.3);
        }

        .transaksi-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .transaksi-info h4 {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .transaksi-info .kode {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-bottom: 4px;
        }

        .transaksi-info .waktu {
            font-size: 12px;
            color: var(--color-text-muted);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border: 1px solid #f59e0b;
        }

        .status-waiting {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .transaksi-details {
            margin-bottom: 15px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .detail-label {
            color: var(--color-text-muted);
        }

        .detail-value {
            color: var(--color-text);
            font-weight: 500;
        }

        .total-amount {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary-light);
        }

        .transaksi-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .btn-detail:hover {
            background: #3b82f6;
            color: white;
        }

        .btn-konfirmasi {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid #10b981;
        }

        .btn-konfirmasi:hover {
            background: #10b981;
            color: white;
        }

        .btn-tolak {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid #ef4444;
        }

        .btn-tolak:hover {
            background: #ef4444;
            color: white;
        }

        /* Empty State */
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
            margin-bottom: 8px;
            color: var(--color-text);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: var(--card-bg);
            margin: 5% auto;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            color: var(--color-text);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .close {
            color: var(--color-text-muted);
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            color: var(--color-primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-text);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 6px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: var(--color-text-muted);
            color: white;
        }

        .btn-cancel:hover {
            background: #6b7280;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--color-success);
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 9999;
            font-size: 14px;
            font-weight: 500;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            background: var(--color-error);
        }

        /* Sidebar Overlay for Mobile */
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

        /* Responsive */
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
                padding: 20px;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .transaksi-actions {
                flex-wrap: wrap;
            }

            .modal-content {
                margin: 20px;
                width: calc(100% - 40px);
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
                <a href="{{ route('aerucoin.index') }}" class="menu-item">
                    <i class="fas fa-coins"></i>
                    <span>Topup AeruCoin</span>
                </a>
                <a href="{{ route('kasir.aerucoin.requests') }}" class="menu-item">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Request AeruCoin</span>
                </a>
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item active">
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
                    <h2>Transaksi Pengguna</h2>
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
                    <h1 class="page-title">
                        <i class="fas fa-shopping-cart"></i>
                        Transaksi Pengguna
                    </h1>
                    <p class="page-subtitle">Kelola dan konfirmasi transaksi yang dibuat oleh pengguna</p>
                </div>

                <!-- Stats -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number">{{ $transaksiPengguna->where('status', 'pending')->count() }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $transaksiPengguna->where('status', 'waiting_confirmation')->count() }}</div>
                        <div class="stat-label">Menunggu Konfirmasi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $transaksiPengguna->total() }}</div>
                        <div class="stat-label">Total Transaksi</div>
                    </div>
                </div>

                <!-- Transaksi Section -->
                <div class="transaksi-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-list"></i>
                            Daftar Transaksi Pengguna
                        </h3>
                        <div class="filter-controls">
                            <select class="filter-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="waiting_confirmation">Menunggu Konfirmasi</option>
                            </select>
                        </div>
                    </div>

                    @if($transaksiPengguna->count() > 0)
                        <div class="transaksi-grid">
                            @foreach($transaksiPengguna as $transaksi)
                                <div class="transaksi-card" data-status="{{ $transaksi->status }}">
                                    <div class="transaksi-header">
                                        <div class="transaksi-info">
                                            <h4>{{ $transaksi->member->nama ?? 'Guest' }}</h4>
                                            <div class="kode">{{ $transaksi->kode_transaksi }}</div>
                                            <div class="waktu">{{ $transaksi->created_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <div class="status-badge status-{{ $transaksi->status }}">
                                            @if($transaksi->status == 'pending')
                                                <i class="fas fa-clock"></i> Pending
                                            @elseif($transaksi->status == 'waiting_confirmation')
                                                <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
                                            @endif
                                        </div>
                                    </div>

                                    <div class="transaksi-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Customer:</span>
                                            <span class="detail-value">{{ $transaksi->customer_name ?? $transaksi->member->nama }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Metode Bayar:</span>
                                            <span class="detail-value">{{ ucfirst($transaksi->payment_method) }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Items:</span>
                                            <span class="detail-value">{{ $transaksi->details->sum('quantity') }} item</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Total:</span>
                                            <span class="detail-value total-amount">Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    <div class="transaksi-actions">
                                        <a href="{{ route('kasir.transaksi-pengguna.detail', $transaksi->id) }}" class="btn btn-detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        @if($transaksi->status == 'pending' || $transaksi->status == 'waiting_confirmation')
                                            <button class="btn btn-konfirmasi" onclick="konfirmasiTransaksi({{ $transaksi->id }})">
                                                <i class="fas fa-check"></i> Konfirmasi
                                            </button>
                                            <button class="btn btn-tolak" onclick="tolakTransaksi({{ $transaksi->id }})">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="pagination">
                            {{ $transaksiPengguna->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Tidak Ada Transaksi</h3>
                            <p>Belum ada transaksi dari pengguna yang perlu dikonfirmasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tolak Transaksi -->
    <div id="tolakModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3 class="modal-title">Tolak Transaksi</h3>
            </div>
            <form id="tolakForm">
                <div class="form-group">
                    <label class="form-label">Alasan Penolakan:</label>
                    <textarea class="form-control" name="alasan_tolak" rows="4"
                              placeholder="Masukkan alasan penolakan transaksi..." required></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-tolak">
                        <i class="fas fa-times"></i> Tolak Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar Toggle for Mobile
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

        // Filter functionality
        document.getElementById('statusFilter').addEventListener('change', function() {
            const filterValue = this.value;
            const cards = document.querySelectorAll('.transaksi-card');

            cards.forEach(card => {
                if (filterValue === '' || card.dataset.status === filterValue) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Modal functionality
        const modal = document.getElementById('tolakModal');
        const closeBtn = document.querySelector('.close');
        const cancelBtns = document.querySelectorAll('.btn-cancel');
        let currentTransaksiId = null;

        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }

        cancelBtns.forEach(btn => {
            btn.onclick = function() {
                modal.style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Konfirmasi transaksi
        function konfirmasiTransaksi(transaksiId) {
            if (confirm('Yakin ingin mengonfirmasi transaksi ini?')) {
                fetch(`/kasir/transaksi-pengguna/${transaksiId}/konfirmasi`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showToast(data.message || 'Gagal mengonfirmasi transaksi', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan sistem', 'error');
                });
            }
        }

        // Tolak transaksi
        function tolakTransaksi(transaksiId) {
            currentTransaksiId = transaksiId;
            modal.style.display = 'block';
        }

        // Handle form tolak
        document.getElementById('tolakForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const alasanTolak = formData.get('alasan_tolak');

            fetch(`/kasir/transaksi-pengguna/${currentTransaksiId}/tolak`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    alasan_tolak: alasanTolak
                })
            })
            .then(response => response.json())
            .then(data => {
                modal.style.display = 'none';
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Gagal menolak transaksi', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modal.style.display = 'none';
                showToast('Terjadi kesalahan sistem', 'error');
            });
        });

        // Show toast notification
        function showToast(message, type = 'success') {
            const existingToast = document.querySelector('.toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>
