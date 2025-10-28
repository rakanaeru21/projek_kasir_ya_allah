<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Kasir Yaallah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #DD88CF;
            --color-primary-light: #E6A3DC;
            --color-primary-dark: #C76BB8;
            --color-secondary: #FFE900;
            --color-bg: #1B3C53;
            --color-bg-alt: #152e42;
            --color-text: #F5F5F5;
            --color-text-muted: #b8c5d0;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-error: #ef4444;
            --card-bg: #234a65;
            --card-hover-bg: #2a5672;
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
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: var(--card-bg);
            border-right: 1px solid rgba(221, 136, 207, 0.2);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(221, 136, 207, 0.2);
            background: var(--color-bg);
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -0.5px;
            color: var(--color-text);
        }

        .sidebar-header h2 i {
            color: var(--color-primary);
            margin-right: 8px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--color-text-muted);
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-item:hover {
            background: rgba(221, 136, 207, 0.1);
            color: var(--color-text);
            text-decoration: none;
        }

        .nav-item.active {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(221, 136, 207, 0.4);
        }

        .nav-item i {
            font-size: 18px;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .nav-item span {
            font-weight: 500;
        }

        .nav-item .cart-badge {
            margin-left: auto;
            background: var(--color-error);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(221, 136, 207, 0.2);
            background: var(--color-bg);
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            padding: 12px;
            background: rgba(221, 136, 207, 0.1);
            border-radius: 8px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            font-size: 16px;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--color-text);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-logout {
            width: 100%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(221, 136, 207, 0.4);
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.6);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 0;
            background: var(--color-bg-alt);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar h2 {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .navbar h2 a {
            color: white;
            text-decoration: none;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-icon {
            position: relative;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .cart-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--color-error);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
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
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            color: var(--color-primary-light);
            transform: translateX(-5px);
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Page Header */
        .page-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
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

        /* Filter Bar */
        .filter-bar {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .filter-row {
            display: grid;
            grid-template-columns: auto auto auto 1fr;
            gap: 15px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-label {
            font-size: 12px;
            color: var(--color-text-muted);
            font-weight: 600;
        }

        .filter-input {
            padding: 8px 12px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 6px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            min-width: 120px;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .btn-filter {
            background: var(--color-primary);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            align-self: end;
            height: fit-content;
        }

        /* Transactions */
        .transactions-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .transaction-card {
            background: var(--color-bg-alt);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
            border: 1px solid rgba(221, 136, 207, 0.2);
            transition: all 0.3s ease;
        }

        .transaction-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(221, 136, 207, 0.2);
        }

        .transaction-header {
            display: flex;
            justify-content: between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .transaction-info {
            flex: 1;
        }

        .transaction-code {
            font-size: 18px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .transaction-date {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-bottom: 8px;
        }

        .transaction-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
        }

        .transaction-amount {
            text-align: right;
        }

        .amount-total {
            font-size: 20px;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 4px;
        }

        .payment-method {
            font-size: 12px;
            color: var(--color-text-muted);
            text-transform: capitalize;
        }

        .transaction-items {
            margin-bottom: 16px;
        }

        .items-summary {
            font-size: 14px;
            color: var(--color-text-muted);
            margin-bottom: 8px;
        }

        .item-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .item-badge {
            background: rgba(221, 136, 207, 0.2);
            color: var(--color-primary);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
        }

        .transaction-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-detail {
            background: var(--color-primary);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            background: var(--color-primary-dark);
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        /* Empty State */
        .empty-transactions {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-text-muted);
        }

        .empty-transactions i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-transactions h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: var(--color-text);
        }

        .empty-transactions p {
            margin-bottom: 20px;
        }

        .btn-shop {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 12px 24px;
            border: none;
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

        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: var(--card-bg);
            color: var(--color-text);
            border: 1px solid rgba(221, 136, 207, 0.3);
        }

        .pagination a:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        .pagination .active span {
            background: var(--color-primary);
            color: white;
            border: 1px solid var(--color-primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1001;
                background: var(--color-primary);
                color: white;
                border: none;
                padding: 12px;
                border-radius: 8px;
                cursor: pointer;
                font-size: 18px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .container {
                padding: 80px 20px 40px;
                margin: 0 auto;
            }

            .filter-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .transaction-header {
                flex-direction: column;
                gap: 12px;
            }

            .transaction-amount {
                text-align: left;
            }

            .transaction-actions {
                justify-content: flex-start;
            }

            .item-list {
                flex-direction: column;
            }
        }

        .mobile-menu-toggle {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-store"></i> Kasir Yaallah</h2>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('pengguna.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengguna.produk') }}" class="nav-item">
                <i class="fas fa-boxes"></i>
                <span>Belanja Produk</span>
            </a>
            <a href="{{ route('pengguna.keranjang') }}" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
                <span class="cart-badge" id="sidebarCartBadge" style="display: none;">0</span>
            </a>
            <a href="{{ route('pengguna.history') }}" class="nav-item active">
                <i class="fas fa-history"></i>
                <span>Riwayat Belanja</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->nama ?? 'User' }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->role ?? 'pengguna') }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
        <a href="{{ route('pengguna.dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="page-header">
            <h1 class="page-title">Riwayat Transaksi</h1>
            <p class="page-subtitle">Lihat semua transaksi yang pernah Anda lakukan</p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <form method="GET" action="{{ route('pengguna.history') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select name="status" class="filter-input">
                            <option value="">Semua Status</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Dari Tanggal</label>
                        <input type="date"
                               name="start_date"
                               class="filter-input"
                               value="{{ request('start_date') }}">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Sampai Tanggal</label>
                        <input type="date"
                               name="end_date"
                               class="filter-input"
                               value="{{ request('end_date') }}">
                    </div>

                    <div class="filter-group">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions -->
        <div class="transactions-section">
            @if($transaksis->count() > 0)
                @foreach($transaksis as $transaksi)
                    <div class="transaction-card">
                        <div class="transaction-header">
                            <div class="transaction-info">
                                <div class="transaction-code">{{ $transaksi->kode_transaksi }}</div>
                                <div class="transaction-date">
                                    {{ $transaksi->created_at->format('d M Y, H:i') }}
                                    @if($transaksi->member_id && $transaksi->member_id == auth()->id())
                                        <span style="display: inline-block; margin-left: 8px; background: var(--color-primary); color: white; font-size: 10px; padding: 2px 6px; border-radius: 8px;">
                                            <i class="fas fa-user-tie"></i> Via Kasir
                                        </span>
                                    @else
                                        <span style="display: inline-block; margin-left: 8px; background: var(--color-success); color: white; font-size: 10px; padding: 2px 6px; border-radius: 8px;">
                                            <i class="fas fa-shopping-cart"></i> Online
                                        </span>
                                    @endif
                                </div>
                                @if($transaksi->member_id && $transaksi->member_id == auth()->id() && $transaksi->user)
                                    <div style="font-size: 11px; color: var(--color-text-muted); margin-bottom: 8px;">
                                        <i class="fas fa-user-tie"></i> Dilayani oleh: {{ $transaksi->user->nama }}
                                    </div>
                                @endif
                                <span class="transaction-status status-{{ $transaksi->status }}">
                                    @switch($transaksi->status)
                                        @case('completed')
                                            <i class="fas fa-check-circle"></i> Selesai
                                            @break
                                        @case('pending')
                                            <i class="fas fa-clock"></i> Pending
                                            @break
                                        @case('cancelled')
                                            <i class="fas fa-times-circle"></i> Dibatalkan
                                            @break
                                        @default
                                            {{ ucfirst($transaksi->status) }}
                                    @endswitch
                                </span>
                            </div>

                            <div class="transaction-amount">
                                <div class="amount-total">Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</div>
                                <div class="payment-method">{{ $transaksi->payment_method }}</div>
                            </div>
                        </div>

                        <div class="transaction-items">
                            <div class="items-summary">
                                {{ $transaksi->details->count() }} item dibeli
                            </div>
                            <div class="item-list">
                                @foreach($transaksi->details->take(3) as $detail)
                                    <span class="item-badge">
                                        {{ $detail->produk->nama_produk ?? 'Produk Dihapus' }} ({{ $detail->quantity }}x)
                                    </span>
                                @endforeach
                                @if($transaksi->details->count() > 3)
                                    <span class="item-badge">
                                        +{{ $transaksi->details->count() - 3 }} lainnya
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="transaction-actions">
                            <a href="{{ route('pengguna.history.detail', $transaksi->id) }}" class="btn-detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $transaksis->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-transactions">
                    <i class="fas fa-receipt"></i>
                    <h3>Belum Ada Transaksi</h3>
                    <p>Anda belum melakukan transaksi apapun</p>
                    <a href="{{ route('pengguna.produk') }}" class="btn-shop">
                        <i class="fas fa-store"></i> Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        }

        mobileMenuToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on nav items (mobile)
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });

        // Update cart badge
        function updateCartBadge() {
            fetch('{{ route("pengguna.cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cartBadge');
                    const sidebarBadge = document.getElementById('sidebarCartBadge');

                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                            badge.style.display = 'flex';
                        }
                        if (sidebarBadge) {
                            sidebarBadge.textContent = data.count;
                            sidebarBadge.style.display = 'flex';
                        }
                    } else {
                        if (badge) {
                            badge.style.display = 'none';
                        }
                        if (sidebarBadge) {
                            sidebarBadge.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error updating cart badge:', error));
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
        });
    </script>
</body>
</html>
