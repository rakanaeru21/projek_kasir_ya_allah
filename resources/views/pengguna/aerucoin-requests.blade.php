{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\pengguna\aerucoin-requests.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request AeruCoin - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Include the same CSS variables and styles from dashboard */
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

        /* Sidebar styles (same as dashboard) */
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

        /* Main content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 0;
            background: var(--color-bg-alt);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
        }

        .page-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            border-left: 6px solid var(--color-primary);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .page-header h1 {
            color: var(--color-text);
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header p {
            color: var(--color-text-muted);
            font-size: 16px;
            margin: 0;
        }

        .requests-section {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .section-title {
            color: var(--color-text);
            margin-bottom: 24px;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 3px solid var(--color-primary);
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .request-item {
            background: var(--color-bg);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 16px;
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .request-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .request-item.pending {
            border-left-color: var(--color-warning);
        }

        .request-item.approved {
            border-left-color: var(--color-success);
        }

        .request-item.rejected {
            border-left-color: var(--color-error);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .request-info h3 {
            color: var(--color-text);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .request-date {
            color: var(--color-text-muted);
            font-size: 14px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
            border: 1px solid var(--color-warning);
        }

        .status-badge.approved {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
            border: 1px solid var(--color-success);
        }

        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
            border: 1px solid var(--color-error);
        }

        .request-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .detail-item {
            background: rgba(205, 79, 184, 0.1);
            padding: 16px;
            border-radius: 8px;
        }

        .detail-label {
            color: var(--color-text-muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .detail-value {
            color: var(--color-text);
            font-size: 16px;
            font-weight: 600;
        }

        .detail-value.amount {
            color: var(--color-primary-light);
            font-size: 18px;
        }

        .request-description {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .request-description h4 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .request-description p {
            color: var(--color-text-muted);
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .approval-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .approval-info.approved {
            border-left-color: var(--color-success);
        }

        .approval-info.rejected {
            border-left-color: var(--color-error);
        }

        .approval-info h4 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .approval-info p {
            color: var(--color-text-muted);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .approval-info small {
            color: var(--color-text-muted);
            font-size: 12px;
        }

        .no-requests {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-text-muted);
        }

        .no-requests i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
            color: var(--color-primary);
        }

        .no-requests h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: var(--color-text);
        }

        .no-requests p {
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            border: none;
            padding: 12px 24px;
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
            text-decoration: none;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 30px;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: var(--color-bg);
            color: var(--color-text-muted);
            border: 1px solid rgba(205, 79, 184, 0.3);
        }

        .pagination a:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        .pagination .current {
            background: var(--color-primary);
            color: white;
            border: 1px solid var(--color-primary);
        }

        .pagination .disabled {
            background: var(--color-bg);
            color: var(--color-text-muted);
            opacity: 0.5;
            cursor: not-allowed;
            border: 1px solid rgba(205, 79, 184, 0.1);
        }

        /* Mobile responsive */
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

            .container {
                padding: 20px;
            }

            .request-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .request-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-store"></i> AeruStore</h2>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('pengguna.dashboard') }}" class="nav-item">
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
            </a>
            <a href="{{ route('pengguna.history') }}" class="nav-item">
                <i class="fas fa-history"></i>
                <span>Riwayat Belanja</span>
            </a>
            <a href="{{ route('aerucoin.request.index') }}" class="nav-item active">
                <i class="fas fa-coins"></i>
                <span>Request AeruCoin</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->nama }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
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
            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-coins"></i> Request AeruCoin</h1>
                <p>Kelola permintaan penambahan AeruCoin Anda</p>
            </div>

            <!-- Requests Section -->
            <div class="requests-section">
                <h2 class="section-title">
                    <i class="fas fa-list"></i> Riwayat Request
                </h2>

                @if(session('success'))
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid var(--color-success); color: var(--color-success); padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--color-error); color: var(--color-error); padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif

                @if($requests->count() > 0)
                    @foreach($requests as $request)
                        <div class="request-item {{ $request->status }}">
                            <div class="request-header">
                                <div class="request-info">
                                    <h3>Request #{{ $request->id }}</h3>
                                    <div class="request-date">
                                        <i class="fas fa-calendar"></i> {{ $request->created_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <div class="status-badge {{ $request->status }}">
                                    @if($request->status == 'pending')
                                        <i class="fas fa-clock"></i> Menunggu Persetujuan
                                    @elseif($request->status == 'approved')
                                        <i class="fas fa-check"></i> Disetujui
                                    @else
                                        <i class="fas fa-times"></i> Ditolak
                                    @endif
                                </div>
                            </div>

                            <div class="request-details">
                                <div class="detail-item">
                                    <div class="detail-label">Jumlah AeruCoin</div>
                                    <div class="detail-value amount">{{ $request->formatted_amount }} AC</div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Uang Tunai</div>
                                    <div class="detail-value">Rp {{ $request->formatted_cash_amount }}</div>
                                </div>
                                @if($request->approved_at)
                                    <div class="detail-item">
                                        <div class="detail-label">Tanggal Diproses</div>
                                        <div class="detail-value">{{ $request->approved_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @endif
                            </div>

                            @if($request->description)
                                <div class="request-description">
                                    <h4><i class="fas fa-comment"></i> Keterangan</h4>
                                    <p>{{ $request->description }}</p>
                                </div>
                            @endif

                            @if($request->status != 'pending')
                                <div class="approval-info {{ $request->status }}">
                                    <h4>
                                        @if($request->status == 'approved')
                                            <i class="fas fa-user-check"></i> Disetujui oleh
                                        @else
                                            <i class="fas fa-user-times"></i> Ditolak oleh
                                        @endif
                                    </h4>
                                    <p>{{ $request->approvedBy->nama ?? 'System' }}</p>
                                    @if($request->approval_notes)
                                        <p><strong>Catatan:</strong> {{ $request->approval_notes }}</p>
                                    @endif
                                    <small>{{ $request->approved_at->format('d M Y, H:i') }}</small>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if($requests->hasPages())
                        <div class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($requests->onFirstPage())
                                <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                            @else
                                <a href="{{ $requests->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($requests->getUrlRange(1, $requests->lastPage()) as $page => $url)
                                @if ($page == $requests->currentPage())
                                    <span class="current">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($requests->hasMorePages())
                                <a href="{{ $requests->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            @else
                                <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                            @endif
                        </div>
                    @endif
                @else
                    <div class="no-requests">
                        <i class="fas fa-coins"></i>
                        <h3>Belum Ada Request</h3>
                        <p>Anda belum pernah mengajukan request penambahan AeruCoin.<br>Kembali ke dashboard untuk membuat request baru.</p>
                        <a href="{{ route('pengguna.dashboard') }}" class="btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
