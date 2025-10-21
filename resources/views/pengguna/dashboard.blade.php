{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\pengguna\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - Kasir Yaallah</title>
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
   Features Grid - Feature Cards
   ======================================== */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-top: 30px;
}

.feature-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    border-bottom: 4px solid var(--color-primary);
}

.feature-icon {
    font-size: 48px;
    margin-bottom: 16px;
    display: block;
}

.feature-card h3 {
    color: var(--color-text);
    margin-bottom: 12px;
    font-size: 18px;
    font-weight: 600;
}

.feature-card p {
    color: var(--color-text-muted);
    font-size: 14px;
    line-height: 1.5;
}

/* ========================================
   Profile Section - Account Information
   ======================================== */
.profile-section {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    margin-top: 30px;
}

.profile-section h2 {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.profile-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 16px;
    background: var(--color-bg-alt);
    border-radius: 8px;
    border-left: 4px solid var(--color-primary);
    transition: all 0.3s ease;
}

.info-item:hover {
    background: #E8F8F2;
    transform: translateX(5px);
}

.info-label {
    font-weight: 600;
    color: var(--color-primary);
    min-width: 150px;
    font-size: 14px;
}

.info-value {
    color: var(--color-text);
    font-size: 14px;
}

/* ========================================
   Status Badge - Active/Inactive Status
   ======================================== */
.status-active {
    color: var(--color-primary);
    font-weight: 600;
}

.status-inactive {
    color: #DC2626;
    font-weight: 600;
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

    .features-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .profile-info {
        grid-template-columns: 1fr;
    }

    .info-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .info-label {
        margin-bottom: 8px;
    }
}
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>🛒 Kasir Yaallah</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </nav>

    <div class="container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1>👋 Selamat Datang, {{ auth()->user()->nama }}!</h1>
            <p>Senang melihat Anda kembali di sistem kami.</p>
            <span class="info-badge">{{ ucfirst(auth()->user()->role) }}</span>
        </div>

        <!-- Features Grid -->
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">📦</span>
                <h3>Lihat Produk</h3>
                <p>Browse semua produk yang tersedia di toko kami</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🛍️</span>
                <h3>Riwayat Belanja</h3>
                <p>Lihat semua transaksi pembelian Anda</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">👤</span>
                <h3>Profil Saya</h3>
                <p>Kelola informasi akun Anda</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">💬</span>
                <h3>Bantuan</h3>
                <p>Hubungi customer service kami</p>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <h2>📋 Informasi Akun</h2>
            <div class="profile-info">
                <div class="info-item">
                    <span class="info-label">Nama Lengkap:</span>
                    <span class="info-value">{{ auth()->user()->nama }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ auth()->user()->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nomor Telepon:</span>
                    <span class="info-value">{{ auth()->user()->nomor_telepon }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Role:</span>
                    <span class="info-value">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status Akun:</span>
                    <span class="info-value">
                        @if(auth()->user()->is_active)
                            <span class="status-active">✓ Aktif</span>
                        @else
                            <span class="status-inactive">✗ Tidak Aktif</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Terdaftar Sejak:</span>
                    <span class="info-value">{{ auth()->user()->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
