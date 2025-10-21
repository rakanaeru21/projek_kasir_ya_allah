{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\admin\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kasir Yaallah</title>
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
:root {
    --color-primary: #07CB73;
    --color-primary-light: #34D99A;
    --color-primary-dark: #059A5A;
    --color-secondary: #FFE900;
    --color-secondary-light: #FFF654;
    --color-bg: #FFFFFF;
    --color-bg-alt: #F9FBFB;
    --color-text: #1A1A1A;
    --color-text-muted: #637381;
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
   Navbar - Top Navigation
   ======================================== */
.navbar {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: white;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.navbar h2 {
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.5px;
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
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.btn-logout:hover {
    background: var(--color-bg-alt);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
   Welcome Card - Hero Section
   ======================================== */
.welcome-card {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    border-left: 6px solid var(--color-primary);
}

.welcome-card h1 {
    color: var(--color-text);
    margin-bottom: 16px;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.welcome-card p {
    color: var(--color-text-muted);
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

.welcome-card p strong {
    color: var(--color-primary);
    font-weight: 600;
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
    box-shadow: 0 2px 8px rgba(7, 203, 115, 0.3);
}

/* ========================================
   Stats Grid - Dashboard Statistics
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-top: 30px;
}

.stat-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border-bottom: 4px solid var(--color-primary);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.stat-card h3 {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    font-size: 36px;
    font-weight: 700;
    color: var(--color-primary);
    line-height: 1;
}

/* ========================================
   Quick Actions - Action Buttons
   ======================================== */
.quick-actions {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-top: 30px;
}

.quick-actions h2 {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.action-btn {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 16px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(7, 203, 115, 0.3);
    text-align: center;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(7, 203, 115, 0.4);
}

.action-btn:active {
    transform: translateY(0);
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
@media (max-width: 768px) {
    .navbar {
        padding: 16px 20px;
        flex-direction: column;
        gap: 16px;
    }

    .navbar h2 {
        font-size: 20px;
    }

    .container {
        padding: 0 20px;
        margin: 24px auto;
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

    .action-buttons {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>🏢 Kasir Yaallah - Admin Panel</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </nav>

    <div class="container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1>👋 Selamat Datang, {{ auth()->user()->nama }}!</h1>
            <p>Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
            <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
            <span class="info-badge">Administrator</span>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-card">
                <h3>Total Products</h3>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-card">
                <h3>Total Transactions</h3>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-card">
                <h3>Revenue Today</h3>
                <div class="stat-number">Rp 0</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>⚡ Quick Actions</h2>
            <div class="action-buttons">
                <button class="action-btn">➕ Tambah User</button>
                <button class="action-btn">📦 Kelola Produk</button>
                <button class="action-btn">📊 Lihat Laporan</button>
                <button class="action-btn">⚙️ Pengaturan</button>
            </div>
        </div>
    </div>
</body>
</html>
