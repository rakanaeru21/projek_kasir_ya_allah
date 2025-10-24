<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $transaksi->id }} - Kasir Yaallah</title>
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

.btn-back {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-back:hover {
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
   Detail Card Styles
   ======================================== */
.detail-card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
    margin-bottom: 20px;
}

.detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 20px;
}

.detail-header h2 {
    color: var(--color-text);
    font-size: 24px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}

.status-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
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

.transaction-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.info-item {
    background: rgba(205, 79, 184, 0.1);
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid var(--color-primary);
}

.info-item label {
    display: block;
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-item span {
    color: var(--color-text);
    font-size: 16px;
    font-weight: 600;
}

.items-section h3 {
    color: var(--color-text);
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: 600;
    border-bottom: 2px solid var(--color-primary);
    padding-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.items-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.items-table th {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 16px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.items-table th:first-child {
    border-top-left-radius: 8px;
}

.items-table th:last-child {
    border-top-right-radius: 8px;
}

.items-table td {
    padding: 16px;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
    color: var(--color-text-muted);
    background: rgba(35, 74, 101, 0.3);
}

.items-table tr:hover td {
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
}

.total-section {
    background: rgba(205, 79, 184, 0.15);
    padding: 20px;
    border-radius: 8px;
    text-align: right;
    margin-top: 20px;
}

.total-section h4 {
    color: var(--color-text);
    font-size: 20px;
    font-weight: 700;
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
        font-size: 18px;
    }

    .container {
        padding: 0 20px;
        margin: 24px auto;
    }

    .detail-card {
        padding: 20px;
    }

    .detail-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .transaction-info {
        grid-template-columns: 1fr;
    }

    .items-table {
        font-size: 14px;
    }

    .items-table th,
    .items-table td {
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
                <h2><i class="fas fa-cash-register"></i> Kasir Yaallah</h2>
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
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('kasir.history') }}" class="menu-item active">
                    <i class="fas fa-history"></i>
                    <span>History Transaksi</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
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
                    <h2>Detail Transaksi #{{ $transaksi->id }}</h2>
                </div>
                <div class="navbar-right">
                    <a href="{{ route('kasir.history') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </nav>

            <div class="container">
                <div class="detail-card">
                    <div class="detail-header">
                        <h2>
                            <i class="fas fa-receipt"></i>
                            Detail Transaksi #{{ $transaksi->id }}
                        </h2>
                        @if($transaksi->status == 'completed')
                        <span class="status-badge status-selesai">Selesai</span>
                        @elseif($transaksi->status == 'cancelled')
                        <span class="status-badge status-batal">Batal</span>
                        @else
                        <span class="status-badge status-pending">Pending</span>
                        @endif
                    </div>

                    <div class="transaction-info">
                        <div class="info-item">
                            <label>Tanggal Transaksi</label>
                            <span>{{ $transaksi->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Waktu</label>
                            <span>{{ $transaksi->created_at->format('H:i:s') }} WIB</span>
                        </div>
                        <div class="info-item">
                            <label>Total Item</label>
                            <span>{{ $transaksi->details->sum('quantity') }} item</span>
                        </div>
                        <div class="info-item">
                            <label>Total Harga</label>
                            <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="items-section">
                        <h3>
                            <i class="fas fa-list"></i>
                            Item Transaksi
                        </h3>

                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi->details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $detail->produk->nama_produk }}</strong></td>
                                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td><strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="total-section">
                            <h4>Total: Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</h4>
                        </div>
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
    </script>
</body>
</html>
