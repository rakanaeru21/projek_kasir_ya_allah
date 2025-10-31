{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\kasir\aerucoin-history.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History AeruCoin - AeruStore</title>
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
    background: linear-gradient(135deg, var(--color-bg) 0%, var(--color-bg-alt) 100%);
    color: var(--color-text);
    line-height: 1.6;
    min-height: 100vh;
}

/* ========================================
   Sidebar Styles
   ======================================== */
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: var(--sidebar-width);
    height: 100vh;
    background: var(--color-bg-alt);
    padding: 20px;
    border-right: 2px solid var(--color-primary);
    z-index: 1000;
    transition: transform 0.3s ease;
}

.sidebar-header {
    text-align: center;
    margin-bottom: 40px;
}

.sidebar-header h1 {
    color: var(--color-primary);
    font-size: 1.8rem;
    margin-bottom: 5px;
}

.sidebar-header p {
    color: var(--color-text-muted);
    font-size: 0.9rem;
}

.nav-menu {
    list-style: none;
}

.nav-item {
    margin-bottom: 10px;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: var(--color-text);
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-link:hover {
    background: var(--color-primary);
    transform: translateX(5px);
}

.nav-link.active {
    background: var(--color-primary);
    color: white;
}

.nav-link i {
    margin-right: 15px;
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
}

/* ========================================
   Main Content Styles
   ======================================== */
.main-content {
    margin-left: var(--sidebar-width);
    padding: 30px;
    min-height: 100vh;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
}

.page-title {
    font-size: 2.2rem;
    color: var(--color-primary);
    display: flex;
    align-items: center;
    gap: 15px;
}

.page-title i {
    font-size: 2rem;
}

/* ========================================
   Card Styles
   ======================================== */
.card {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.card-title {
    font-size: 1.4rem;
    color: var(--color-primary);
    font-weight: 600;
}

/* ========================================
   Form Styles
   ======================================== */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--color-text);
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    background: var(--color-bg);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: var(--color-text);
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
}

.form-select {
    background-image: url("data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='%23F5F5F5' fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

/* ========================================
   Button Styles
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(205, 79, 184, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20934a 100%);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #34ce57 0%, #28a745 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

/* ========================================
   Table Styles
   ======================================== */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.table th {
    background: var(--color-bg);
    color: var(--color-primary);
    font-weight: 600;
}

.table tr:hover {
    background: rgba(255, 255, 255, 0.05);
}

/* ========================================
   Badge Styles
   ======================================== */
.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
}

/* ========================================
   Filter Form
   ======================================== */
.filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    align-items: end;
}

/* ========================================
   Pagination
   ======================================== */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}

.pagination a,
.pagination span {
    padding: 8px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: var(--color-text);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.pagination a:hover {
    background: var(--color-primary);
    color: white;
}

.pagination .active {
    background: var(--color-primary);
    color: white;
}

/* ========================================
   Mobile Responsiveness
   ======================================== */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
    }

    .sidebar.mobile-open {
        transform: translateX(0);
    }

    .main-content {
        margin-left: 0;
        padding: 20px;
    }

    .filter-form {
        grid-template-columns: 1fr;
    }

    .table-responsive {
        overflow-x: auto;
    }
}
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1><i class="fas fa-store"></i> AeruStore</h1>
            <p>Sistem Kasir</p>
        </div>

        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('kasir.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kasir.transaksi') }}" class="nav-link">
                        <i class="fas fa-cash-register"></i>
                        Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('aerucoin.index') }}" class="nav-link">
                        <i class="fas fa-coins"></i>
                        Topup AeruCoin
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('aerucoin.history') }}" class="nav-link active">
                        <i class="fas fa-history"></i>
                        History AeruCoin
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kasir.history') }}" class="nav-link">
                        <i class="fas fa-list"></i>
                        History Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kasir.laporan') }}" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h1 class="page-title">
                <i class="fas fa-history"></i>
                History Transaksi AeruCoin
            </h1>
            <a href="{{ route('aerucoin.index') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Topup Baru
            </a>
        </div>

        <!-- Filter Form -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-filter"></i>
                    Filter Transaksi
                </h2>
            </div>

            <form method="GET" action="{{ route('aerucoin.history') }}">
                <div class="filter-form">
                    <div class="form-group">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-control form-select">
                            <option value="">-- Semua User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Tipe Transaksi</label>
                        <select name="type" id="type" class="form-control form-select">
                            <option value="">-- Semua Tipe --</option>
                            <option value="topup" {{ request('type') == 'topup' ? 'selected' : '' }}>Topup</option>
                            <option value="usage" {{ request('type') == 'usage' ? 'selected' : '' }}>Penggunaan</option>
                            <option value="refund" {{ request('type') == 'refund' ? 'selected' : '' }}>Refund</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_from" class="form-label">Dari Tanggal</label>
                        <input type="date" name="date_from" id="date_from" class="form-control"
                               value="{{ request('date_from') }}">
                    </div>

                    <div class="form-group">
                        <label for="date_to" class="form-label">Sampai Tanggal</label>
                        <input type="date" name="date_to" id="date_to" class="form-control"
                               value="{{ request('date_to') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-list"></i>
                    Daftar Transaksi
                </h2>
                <span class="badge badge-success">
                    {{ $transactions->total() }} Total Transaksi
                </span>
            </div>

            @if($transactions->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Waktu</th>
                                <th>User</th>
                                <th>Tipe</th>
                                <th>Jumlah Coin</th>
                                <th>Uang Tunai</th>
                                <th>Kasir</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <strong>{{ $transaction->user->nama }}</strong><br>
                                        <small class="text-muted">{{ $transaction->user->nomor_telepon }}</small>
                                    </td>
                                    <td>
                                        @if($transaction->type == 'topup')
                                            <span class="badge badge-success">Topup</span>
                                        @elseif($transaction->type == 'usage')
                                            <span class="badge badge-warning">Penggunaan</span>
                                        @else
                                            <span class="badge badge-danger">Refund</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaction->type == 'usage')
                                            -{{ number_format($transaction->amount, 0, ',', '.') }}
                                        @else
                                            +{{ number_format($transaction->amount, 0, ',', '.') }}
                                        @endif
                                        Coin
                                    </td>
                                    <td>
                                        @if($transaction->cash_received)
                                            Rp {{ number_format($transaction->cash_received, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $transaction->kasir->nama }}</td>
                                    <td>{{ $transaction->description ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 40px;">
                    <i class="fas fa-empty-set" style="font-size: 3rem; color: var(--color-text-muted); margin-bottom: 20px;"></i>
                    <p style="color: var(--color-text-muted); font-size: 1.1rem;">Tidak ada transaksi ditemukan</p>
                    <p style="color: var(--color-text-muted); margin-bottom: 20px;">Coba ubah filter atau buat transaksi baru</p>
                    <a href="{{ route('aerucoin.index') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Buat Topup Baru
                    </a>
                </div>
            @endif
        </div>
    </main>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto submit form when filter changes (optional)
            const filterInputs = document.querySelectorAll('#user_id, #type, #date_from, #date_to');

            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Uncomment to auto-submit on change
                    // this.form.submit();
                });
            });
        });
    </script>
</body>
</html>
