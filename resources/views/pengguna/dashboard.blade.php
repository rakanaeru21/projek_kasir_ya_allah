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
    --color-primary: #DD88CF;
    --color-primary-light: #DD88CF;
    --color-primary-dark: #DD88CF;
    --color-secondary: #FFE900;
    --color-secondary-light: #FFF654;
    --color-bg: #1B3C53;
    --color-bg-alt: #1B3C53;
    --color-text: #F5F5F5;
    --color-text-muted: #f5f5f5;
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
    background: #234C6A;
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
    box-shadow: 0 2px 8px rgba(255, 0, 123, 0.3);
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
    background: #234C6A;
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
    background: #234C6A;
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
        <h2>Kasir Yaallah</h2>
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

</body>
</html>
