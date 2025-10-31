<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Transaksi - AeruStore</title>
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
   History Table Styles
   ======================================== */
.history-card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.history-card h2 {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 24px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.table-container {
    overflow-x: auto;
    margin-bottom: 20px;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.history-table th {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 16px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.history-table th:first-child {
    border-top-left-radius: 8px;
}

.history-table th:last-child {
    border-top-right-radius: 8px;
}

.history-table td {
    padding: 16px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
    color: var(--color-text-muted);
    background: rgba(35, 74, 101, 0.3);
}

.history-table tr:hover td {
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-selesai {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.status-pending {
    background: linear-gradient(135deg, #ffc107, #ffeb3b);
    color: #333;
}

.status-batal {
    background: linear-gradient(135deg, #dc3545, #e74c3c);
    color: white;
}

.btn-detail {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: 12px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.btn-print {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: 12px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-print:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}

/* ========================================
   Pagination Styles
   ======================================== */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
    gap: 8px;
}

.pagination .page-link {
    padding: 10px 15px;
    background: var(--card-bg);
    color: var(--color-text-muted);
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.3s ease;
    border: 1px solid rgba(205, 79, 184, 0.2);
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
    font-size: 24px;
    margin-bottom: 12px;
    color: var(--color-text);
}

.empty-state p {
    font-size: 16px;
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

    .history-card {
        padding: 20px;
    }

    .history-card h2 {
        font-size: 20px;
    }

    .history-table {
        font-size: 14px;
    }

    .history-table th,
    .history-table td {
        padding: 12px 8px;
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
                <a href="{{ route('kasir.history') }}" class="menu-item active">
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
                    <h2>History Transaksi</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <div class="history-card">
                    <h2>
                        <i class="fas fa-history"></i>
                        Riwayat Transaksi
                    </h2>

                    @if($transaksis->count() > 0)
                    <div class="table-container">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksis as $transaksi)
                                <tr>
                                    <td><strong>#{{ $transaksi->id }}</strong></td>
                                    <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $transaksi->details->sum('quantity') }} item</td>
                                    <td><strong>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @if($transaksi->status == 'completed')
                                        <span class="status-badge status-selesai">Selesai</span>
                                        @elseif($transaksi->status == 'cancelled')
                                        <span class="status-badge status-batal">Batal</span>
                                        @else
                                        <span class="status-badge status-pending">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('kasir.history.show', $transaksi->id) }}" class="btn-detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('kasir.history.print', $transaksi->id) }}" class="btn-print" target="_blank" style="margin-left: 5px;">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        {{ $transaksis->links('pagination::simple-bootstrap-4') }}
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <h3>Belum Ada Transaksi</h3>
                        <p>Riwayat transaksi akan muncul di sini setelah ada transaksi yang dilakukan.</p>
                    </div>
                    @endif
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
    </script>
</body>
</html>
