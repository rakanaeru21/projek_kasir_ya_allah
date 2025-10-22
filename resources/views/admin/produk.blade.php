{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\admin\produk.blade.php --}}
@php
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Produk[] $produks */
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Kasir Yaallah</title>
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
:root {
    --color-primary: #cd4fb8;
    --color-primary-light: #cd4fb8;
    --color-primary-dark: #cd4fb8;
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

.nav-left { display: flex; align-items: center; gap: 12px; }
        .nav-center { display: flex; gap: 16px; align-items: center; }
        .nav-right { display: flex; align-items: center; gap: 12px; }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: background .25s, color .25s, transform .25s, opacity .25s;
            opacity: .9;
        }
        .nav-link:hover {
            background: rgba(255,255,255,.15);
            opacity: 1;
            transform: translateY(-1px);
        }
        .nav-link.active {
            background: #ffffff;
            color: var(--color-primary);
            box-shadow: 0 2px 8px rgba(7,203,115,.25);
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
    box-shadow: 0 2px 8px rgba(255, 0, 123, 0.3);
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
    background: #234C6A;
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
    background: #234C6A;
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
    box-shadow: 0 4px 12px #dc72cb;
    text-align: center;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px #dc72cb;
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
        <div class="nav-left">
            <h2>🛒 Kasir Yaallah</h2>
        </div>

        <div class="nav-center">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('admin.produk') }}" class="nav-link {{ request()->routeIs('admin.produk') ? 'active' : '' }}">Produk</a>
            <a href="#" class="nav-link">Riwayat</a>
            <a href="#" class="nav-link">Profil</a>
        </div>

        <div class="nav-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1>Selamat Datang, {{ auth()->user()->nama }}!</h1>
            <p>Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
            <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
            <span class="info-badge">Administrator</span>
        </div>

        <!-- Product Management Section -->
        <div class="quick-actions">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="margin: 0; border: none; padding: 0;">Data Produk</h2>
                <button class="action-btn" onclick="openModal()">+ Tambah Produk</button>
            </div>

            <!-- Product Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden;">
                    <thead>
                        <tr style="background: var(--color-primary); color: white;">
                            <th style="padding: 16px; text-align: left;">No</th>
                            <th style="padding: 16px; text-align: left;">Kode</th>
                            <th style="padding: 16px; text-align: left;">Nama Produk</th>
                            <th style="padding: 16px; text-align: left;">Kategori</th>
                            <th style="padding: 16px; text-align: right;">Harga</th>
                            <th style="padding: 16px; text-align: center;">Stok</th>
                            <th style="padding: 16px; text-align: center;">Status</th>
                            <th style="padding: 16px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks ?? [] as $index => $produk)
                        <tr style="border-bottom: 1px solid #e0e0e0;">
                            <td style="padding: 16px; color: #333;">{{ $index + 1 }}</td>
                            <td style="padding: 16px; color: #333; font-weight: 600;">{{ $produk->kode_produk }}</td>
                            <td style="padding: 16px; color: #333;">{{ $produk->nama_produk }}</td>
                            <td style="padding: 16px; color: #333;">{{ $produk->kategori }}</td>
                            <td style="padding: 16px; color: #333; text-align: right;">Rp {{ number_format((float)$produk->harga, 0, ',', '.') }}</td>
                            <td style="padding: 16px; color: #333; text-align: center;">{{ $produk->stok }} {{ $produk->satuan }}</td>
                            <td style="padding: 16px; text-align: center;">
                                <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;
                                    background: {{ $produk->status == 'aktif' ? '#4CAF50' : '#f44336' }}; color: white;">
                                    {{ ucfirst($produk->status) }}
                                </span>
                            </td>
                            <td style="padding: 16px; text-align: center;">
                                <button onclick="editProduk({{ $produk->id }})" style="padding: 8px 16px; background: #2196F3; color: white; border: none; border-radius: 6px; cursor: pointer; margin-right: 8px;">Edit</button>
                                <button onclick="hapusProduk({{ $produk->id }})" style="padding: 8px 16px; background: #f44336; color: white; border: none; border-radius: 6px; cursor: pointer;">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="padding: 40px; text-align: center; color: #999;">
                                Belum ada data produk
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            alert('Fungsi tambah produk akan segera dibuat');
        }

        function editProduk(id) {
            alert('Edit produk ID: ' + id);
        }

        function hapusProduk(id) {
            if(confirm('Yakin ingin menghapus produk ini?')) {
                alert('Hapus produk ID: ' + id);
            }
        }
    </script>
</body>
</html>
