{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\kasir\aerucoin-topup.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Topup AeruCoin - AeruStore</title>
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

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 40px;
}

/* ========================================
   Card Styles
   ======================================== */
.card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 3px solid var(--color-primary);
}

.card-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--color-text);
    display: flex;
    align-items: center;
    gap: 12px;
}

/* ========================================
   Form Styles
   ======================================== */
.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--color-text);
    font-size: 15px;
}

.form-control {
    width: 100%;
    padding: 14px 16px;
    background: var(--color-bg);
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    color: var(--color-text);
    font-size: 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
    background: var(--color-bg-alt);
}

.form-select {
    background-image: url("data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='%23F5F5F5' fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 16px center;
    background-size: 16px;
    padding-right: 48px;
}

/* ========================================
   Button Styles
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20934a 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.6);
}

/* ========================================
   User Info Display
   ======================================== */
.user-info-display {
    background: var(--color-bg);
    border-radius: 12px;
    padding: 24px;
    margin: 20px 0;
    border: 2px solid var(--color-primary);
    box-shadow: 0 4px 15px rgba(205, 79, 184, 0.2);
}

.user-info-display h4 {
    color: var(--color-primary);
    margin-bottom: 16px;
    font-size: 18px;
    font-weight: 600;
}

.user-info-display p {
    margin-bottom: 8px;
    font-size: 15px;
}

.balance-display {
    font-size: 24px;
    font-weight: 700;
    color: var(--color-secondary);
    text-shadow: 0 2px 4px rgba(255, 233, 0, 0.3);
}

/* ========================================
   Alert Styles
   ======================================== */
.alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
    border-left: 4px solid;
    font-weight: 500;
}

.alert-success {
    background-color: rgba(40, 167, 69, 0.1);
    border-color: #28a745;
    color: #d4edda;
}

.alert-error {
    background-color: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
    color: #f8d7da;
}

/* ========================================
   Table Styles
   ======================================== */
.table-responsive {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
}

.table th {
    background: var(--color-bg);
    color: var(--color-primary);
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table tr:hover {
    background: rgba(205, 79, 184, 0.05);
}

/* ========================================
   Loading Animation
   ======================================== */
.loading {
    display: none;
    text-align: center;
    padding: 40px;
    background: var(--card-bg);
    border-radius: 12px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.loading-spinner {
    border: 4px solid rgba(205, 79, 184, 0.3);
    border-radius: 50%;
    border-top: 4px solid var(--color-primary);
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 0 auto 16px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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

    .card {
        padding: 20px;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
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
                <a href="{{ route('aerucoin.index') }}" class="menu-item active">
                    <i class="fas fa-coins"></i>
                    <span>Topup AeruCoin</span>
                </a>
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pengguna</span>
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
                    <h2><i class="fas fa-coins"></i> Topup AeruCoin</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <!-- Alert Messages -->
                <div id="alert-container"></div>

                <!-- Topup Form Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-plus-circle"></i>
                            Form Topup AeruCoin
                        </h2>
                    </div>

                    <form id="topupForm">
                        @csrf
                        <div class="form-group">
                            <label for="user_id" class="form-label">Pilih User</label>
                            <select name="user_id" id="user_id" class="form-control form-select" required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->nomor_telepon }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User Info Display -->
                        <div id="userInfo" class="user-info-display" style="display: none;">
                            <h4><i class="fas fa-user-circle"></i> Informasi User</h4>
                            <p><strong>Nama:</strong> <span id="userName"></span></p>
                            <p><strong>No. Telepon:</strong> <span id="userPhone"></span></p>
                            <p><strong>Saldo Saat Ini:</strong> <span id="currentBalance" class="balance-display"></span> AeruCoin</p>
                        </div>

                        <div class="form-group">
                            <label for="cash_received" class="form-label">Uang Tunai Diterima (Rp)</label>
                            <input type="number" name="cash_received" id="cash_received" class="form-control"
                                   placeholder="Contoh: 50000" min="1000" step="1000" required>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="form-label">Jumlah AeruCoin</label>
                            <input type="number" name="amount" id="amount" class="form-control"
                                   placeholder="Contoh: 50000" min="1000" step="1000" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Keterangan (Opsional)</label>
                            <input type="text" name="description" id="description" class="form-control"
                                   placeholder="Contoh: Topup bulanan">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-coins"></i>
                            Proses Topup
                        </button>
                    </form>
                </div>

                <!-- Recent Transactions Card -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-history"></i>
                            Transaksi Terakhir
                        </h2>
                        <a href="{{ route('aerucoin.history') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i>
                            Lihat Semua
                        </a>
                    </div>

                    @if($recentTransactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>User</th>
                                        <th>Jumlah Coin</th>
                                        <th>Uang Tunai</th>
                                        <th>Kasir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $transaction->user->nama }}</td>
                                            <td>{{ number_format($transaction->amount, 0, ',', '.') }} Coin</td>
                                            <td>Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}</td>
                                            <td>{{ $transaction->kasir->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 16px; opacity: 0.5;"></i>
                            <p style="font-size: 1.1rem; margin-bottom: 8px;">Belum ada transaksi topup</p>
                            <p style="font-size: 0.9rem;">Transaksi akan muncul di sini setelah melakukan topup</p>
                        </div>
                    @endif
                </div>

                <!-- Loading Animation -->
                <div id="loading" class="loading">
                    <div class="loading-spinner"></div>
                    <p style="color: var(--color-text-muted); font-weight: 500;">Memproses topup...</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('user_id');
            const userInfo = document.getElementById('userInfo');
            const topupForm = document.getElementById('topupForm');
            const alertContainer = document.getElementById('alert-container');
            const loading = document.getElementById('loading');
            const cashInput = document.getElementById('cash_received');
            const amountInput = document.getElementById('amount');

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

            // Handle user selection
            userSelect.addEventListener('change', function() {
                const userId = this.value;

                if (userId) {
                    fetch(`/aerucoin/user/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('userName').textContent = data.data.nama;
                                document.getElementById('userPhone').textContent = data.data.nomor_telepon;
                                document.getElementById('currentBalance').textContent = data.data.current_balance;
                                userInfo.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('Terjadi kesalahan saat mengambil data user', 'error');
                        });
                } else {
                    userInfo.style.display = 'none';
                }
            });

            // Auto-calculate AeruCoin amount based on cash (1:1 ratio)
            cashInput.addEventListener('input', function() {
                const cashAmount = parseInt(this.value) || 0;
                amountInput.value = cashAmount;
            });

            // Handle form submission
            topupForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Show loading
                loading.style.display = 'block';
                this.style.display = 'none';

                fetch('/aerucoin/topup', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loading
                    loading.style.display = 'none';
                    topupForm.style.display = 'block';

                    if (data.success) {
                        showAlert(`Topup berhasil! ${data.data.amount} AeruCoin telah ditambahkan ke akun ${data.data.user_name}. Saldo baru: ${data.data.new_balance} AeruCoin`, 'success');

                        // Reset form
                        topupForm.reset();
                        userInfo.style.display = 'none';

                        // Refresh recent transactions (could reload page or fetch new data)
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        showAlert(data.message, 'error');

                        // Show validation errors if any
                        if (data.errors) {
                            let errorMessage = '';
                            Object.values(data.errors).forEach(errors => {
                                errors.forEach(error => {
                                    errorMessage += error + '\n';
                                });
                            });
                            showAlert(errorMessage, 'error');
                        }
                    }
                })
                .catch(error => {
                    // Hide loading
                    loading.style.display = 'none';
                    topupForm.style.display = 'block';

                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan saat memproses topup', 'error');
                });
            });

            function showAlert(message, type) {
                const alert = document.createElement('div');
                alert.className = `alert alert-${type}`;
                alert.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${message}
                `;

                alertContainer.innerHTML = '';
                alertContainer.appendChild(alert);

                // Auto-remove alert after 5 seconds
                setTimeout(() => {
                    alert.remove();
                }, 5000);

                // Scroll to top to show alert
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // Close sidebar on window resize if desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
