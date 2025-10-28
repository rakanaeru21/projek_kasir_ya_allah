{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\pengguna\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Kasir Yaallah</title>
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
    --color-success: #10b981;
    --color-warning: #f59e0b;
    --color-error: #ef4444;
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
    display: flex;
    min-height: 100vh;
}

/* ========================================
   Sidebar Styles
   ======================================== */
.sidebar {
    width: 280px;
    background: var(--card-bg);
    border-right: 1px solid rgba(205, 79, 184, 0.2);
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
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
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
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
    text-decoration: none;
}

.nav-item.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
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
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    background: var(--color-bg);
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding: 12px;
    background: rgba(205, 79, 184, 0.1);
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
   Main Content Area
   ======================================== */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 0;
    background: var(--color-bg-alt);
    min-height: 100vh;
}

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px;
}

/* ========================================
   Welcome Card - Hero Section
   ======================================== */
.welcome-card {
    background: var(--card-bg);
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border-left: 6px solid var(--color-primary);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.welcome-card h1 {
    color: var(--color-text);
    margin-bottom: 16px;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.welcome-card h1 i {
    color: var(--color-primary-light);
}

.welcome-card p {
    color: var(--color-text-muted);
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

.info-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 12px;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

/* ========================================
   Stats Grid - Statistics Cards
   ======================================== */
.stats-grid {
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
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(205, 79, 184, 0.2);
    border-bottom: 4px solid var(--color-primary);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
    background: var(--card-hover-bg);
}

.stat-icon {
    font-size: 48px;
    margin-bottom: 16px;
    display: block;
    color: var(--color-primary-light);
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary-light);
    margin-bottom: 8px;
}

.stat-label {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* ========================================
   Recent Transactions
   ======================================== */
.recent-transactions {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-top: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.section-title {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.section-title i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.transaction-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
}

.transaction-item:last-child {
    border-bottom: none;
}

.transaction-info {
    display: flex;
    align-items: center;
}

.transaction-icon {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.transaction-details h4 {
    color: var(--color-text);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
}

.transaction-details p {
    color: var(--color-text-muted);
    font-size: 12px;
}

.transaction-amount {
    color: var(--color-primary-light);
    font-weight: 700;
    font-size: 16px;
}

.no-transactions {
    text-align: center;
    color: var(--color-text-muted);
    padding: 40px 20px;
}

.no-transactions i {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
    color: var(--color-primary);
}

.view-all-link {
    text-align: center;
    margin-top: 20px;
}

.view-all-link a {
    color: var(--color-primary-light);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.view-all-link a:hover {
    color: var(--color-primary);
    text-decoration: underline;
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
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

    .welcome-card {
        padding: 24px;
    }

    .welcome-card h1 {
        font-size: 24px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .transaction-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .transaction-amount {
        align-self: flex-end;
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
            <a href="{{ route('pengguna.dashboard') }}" class="nav-item active">
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
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('pengguna.history') }}" class="nav-item">
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
                    <div class="user-name">{{ $user->nama }}</div>
                    <div class="user-role">{{ ucfirst($user->role) }}</div>
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
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1><i class="fas fa-hand-wave"></i> Selamat Datang, {{ $user->nama }}!</h1>
            <p>Selamat berbelanja di Kasir Yaallah. Nikmati pengalaman belanja yang mudah dan menyenangkan.</p>
            <span class="info-badge"><i class="fas fa-check-circle"></i> {{ ucfirst($user->role) }}</span>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-receipt stat-icon"></i>
                <div class="stat-number">{{ $totalTransaksi }}</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-money-bill-wave stat-icon"></i>
                <div class="stat-number">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                <div class="stat-label">Total Belanja</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shopping-cart stat-icon"></i>
                <div class="stat-number">{{ $cartCount }}</div>
                <div class="stat-label">Item di Keranjang</div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="recent-transactions">
            <h2 class="section-title"><i class="fas fa-clock"></i> Transaksi Terbaru</h2>

            @if($transaksiTerbaru->count() > 0)
                @foreach($transaksiTerbaru as $transaksi)
                    <div class="transaction-item">
                        <div class="transaction-info">
                            <div class="transaction-icon">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="transaction-details">
                                <h4>{{ $transaksi->kode_transaksi }}</h4>
                                <p>{{ $transaksi->created_at->format('d M Y, H:i') }} • {{ ucfirst($transaksi->payment_method) }}</p>
                            </div>
                        </div>
                        <div class="transaction-amount">
                            Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div class="view-all-link">
                    <a href="{{ route('pengguna.history') }}">
                        <i class="fas fa-arrow-right"></i> Lihat Semua Transaksi
                    </a>
                </div>
            @else
                <div class="no-transactions">
                    <i class="fas fa-receipt"></i>
                    <p>Belum ada transaksi</p>
                    <small>Mulai berbelanja untuk melihat riwayat transaksi</small>
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

        // Update cart badge secara real-time
        function updateCartBadge() {
            fetch('{{ route("pengguna.cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.querySelector('.nav-item .cart-badge');
                    const cartNavItem = document.querySelector('.nav-item[href*="keranjang"]');

                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                        } else {
                            cartNavItem.innerHTML += `<span class="cart-badge">${data.count}</span>`;
                        }
                    } else {
                        if (badge) {
                            badge.remove();
                        }
                    }
                })
                .catch(error => console.error('Error updating cart badge:', error));
        }

        // Update cart badge saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();

            // Update setiap 30 detik
            setInterval(updateCartBadge, 30000);
        });
    </script>
</body>
</html>
