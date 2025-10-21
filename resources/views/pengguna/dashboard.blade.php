{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\pengguna\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar h2 {
            font-size: 24px;
        }
        .btn-logout {
            background: white;
            color: #667eea;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .welcome-card h1 {
            color: #333;
            margin-bottom: 15px;
            font-size: 32px;
        }
        .welcome-card p {
            color: #666;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .feature-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .feature-card h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .feature-card p {
            color: #666;
            font-size: 14px;
        }
        .profile-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .profile-section h2 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        .info-label {
            font-weight: bold;
            color: #667eea;
            min-width: 150px;
        }
        .info-value {
            color: #333;
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
                <div class="feature-icon">📦</div>
                <h3>Lihat Produk</h3>
                <p>Browse semua produk yang tersedia di toko kami</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛍️</div>
                <h3>Riwayat Belanja</h3>
                <p>Lihat semua transaksi pembelian Anda</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👤</div>
                <h3>Profil Saya</h3>
                <p>Kelola informasi akun Anda</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💬</div>
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
                            <span style="color: green;">✓ Aktif</span>
                        @else
                            <span style="color: red;">✗ Tidak Aktif</span>
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
