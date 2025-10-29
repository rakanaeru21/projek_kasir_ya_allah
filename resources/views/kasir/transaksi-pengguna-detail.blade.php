<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi Pengguna - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #cd4fb8;
            --color-primary-light: #e06dd0;
            --color-primary-dark: #b3329d;
            --color-secondary: #FFE900;
            --color-bg: #1B3C53;
            --color-bg-alt: #152e42;
            --color-text: #F5F5F5;
            --color-text-muted: #b8c5d0;
            --sidebar-width: 280px;
            --card-bg: #234a65;
            --card-hover-bg: #2a5672;
            --color-success: #10b981;
            --color-warning: #f59e0b;
            --color-error: #ef4444;
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
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
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

        .menu-item i {
            font-size: 18px;
            margin-right: 16px;
            width: 24px;
            text-align: center;
            color: var(--color-text-muted);
            transition: color 0.3s ease;
        }

        .menu-item:hover i,
        .menu-item.active i {
            color: var(--color-primary);
        }

        .menu-item span {
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--color-bg-alt);
        }

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

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 40px;
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            color: var(--color-primary-light);
            transform: translateX(-5px);
        }

        .back-button i {
            margin-right: 8px;
        }

        /* Detail Layout */
        .detail-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 30px;
        }

        /* Transaction Info */
        .transaction-info {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .info-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(205, 79, 184, 0.2);
        }

        .transaction-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
        }

        .transaction-code {
            font-size: 14px;
            color: var(--color-text-muted);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border: 1px solid #f59e0b;
        }

        .status-waiting {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid #3b82f6;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid #10b981;
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid #ef4444;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: var(--color-bg-alt);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(205, 79, 184, 0.1);
        }

        .info-label {
            font-size: 12px;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-text);
        }

        /* Product List */
        .product-section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(205, 79, 184, 0.2);
        }

        .product-list {
            display: grid;
            gap: 15px;
        }

        .product-item {
            background: var(--color-bg-alt);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(205, 79, 184, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .product-code {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 14px;
            color: var(--color-primary);
            font-weight: 600;
        }

        .product-quantity {
            text-align: right;
            font-size: 14px;
            color: var(--color-text-muted);
        }

        .quantity-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-text);
            display: block;
        }

        .product-total {
            text-align: right;
            font-size: 16px;
            font-weight: 700;
            color: var(--color-primary-light);
        }

        /* Transaction Summary */
        .transaction-summary {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
            height: fit-content;
            position: sticky;
            top: 120px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(205, 79, 184, 0.2);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary-light);
            border-top: 2px solid rgba(205, 79, 184, 0.2);
            padding-top: 15px;
            margin-top: 20px;
        }

        /* Action Buttons */
        .action-buttons {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-konfirmasi {
            background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .btn-konfirmasi:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.6);
        }

        .btn-tolak {
            background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .btn-tolak:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.6);
        }

        .btn-back {
            background: var(--color-bg-alt);
            color: var(--color-text);
            border: 2px solid rgba(205, 79, 184, 0.3);
        }

        .btn-back:hover {
            border-color: var(--color-primary);
            background: rgba(205, 79, 184, 0.1);
            color: var(--color-text);
            text-decoration: none;
        }

        /* Notes */
        .notes-section {
            margin-top: 30px;
            background: var(--color-bg-alt);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(205, 79, 184, 0.1);
        }

        .notes-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 10px;
        }

        .notes-content {
            font-size: 14px;
            color: var(--color-text-muted);
            line-height: 1.6;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: var(--card-bg);
            margin: 5% auto;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            color: var(--color-text);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .close {
            color: var(--color-text-muted);
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            color: var(--color-primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--color-text);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 6px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: var(--color-text-muted);
            color: white;
        }

        .btn-cancel:hover {
            background: #6b7280;
        }

        /* Toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--color-success);
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 9999;
            font-size: 14px;
            font-weight: 500;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.error {
            background: var(--color-error);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .container {
                padding: 20px;
            }

            .navbar {
                padding: 16px 20px;
            }

            .detail-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .transaction-summary {
                order: -1;
                position: static;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .product-item {
                flex-direction: column;
                text-align: center;
            }

            .product-quantity,
            .product-total {
                text-align: center;
            }

            .modal-content {
                margin: 20px;
                width: calc(100% - 40px);
            }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar">
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
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item active">
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
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <nav class="navbar">
                <h2>Detail Transaksi Pengguna</h2>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </nav>

            <div class="container">
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Transaksi
                </a>

                <div class="detail-layout">
                    <!-- Transaction Info -->
                    <div class="transaction-info">
                        <div class="info-header">
                            <div>
                                <h1 class="transaction-title">Transaksi {{ $transaksi->kode_transaksi }}</h1>
                                <div class="transaction-code">{{ $transaksi->created_at->format('d F Y, H:i') }}</div>
                            </div>
                            <div class="status-badge status-{{ $transaksi->status }}">
                                @if($transaksi->status == 'pending')
                                    <i class="fas fa-clock"></i> Pending
                                @elseif($transaksi->status == 'waiting_confirmation')
                                    <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
                                @elseif($transaksi->status == 'completed')
                                    <i class="fas fa-check-circle"></i> Selesai
                                @elseif($transaksi->status == 'cancelled')
                                    <i class="fas fa-times-circle"></i> Dibatalkan
                                @endif
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Customer</div>
                                <div class="info-value">{{ $transaksi->customer_name ?? $transaksi->member->nama }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $transaksi->member->email ?? '-' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Metode Pembayaran</div>
                                <div class="info-value">{{ ucfirst($transaksi->payment_method) }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Item</div>
                                <div class="info-value">{{ $transaksi->details->sum('quantity') }} item</div>
                            </div>
                        </div>

                        <!-- Product List -->
                        <div class="product-section">
                            <h3 class="section-title">
                                <i class="fas fa-shopping-bag"></i>
                                Produk yang Dibeli
                            </h3>
                            <div class="product-list">
                                @foreach($transaksi->details as $detail)
                                    <div class="product-item">
                                        <div class="product-image">
                                            @if($detail->produk->gambar && file_exists(public_path($detail->produk->gambar)))
                                                <img src="{{ asset($detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}">
                                            @else
                                                <i class="fas fa-box"></i>
                                            @endif
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $detail->produk->nama_produk }}</div>
                                            <div class="product-code">{{ $detail->produk->kode_produk }}</div>
                                            <div class="product-price">Rp {{ number_format($detail->harga, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="product-quantity">
                                            <span class="quantity-value">{{ $detail->quantity }}</span>
                                            <span>qty</span>
                                        </div>
                                        <div class="product-total">
                                            Rp {{ number_format($detail->harga * $detail->quantity, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if($transaksi->notes)
                            <div class="notes-section">
                                <div class="notes-title">
                                    <i class="fas fa-sticky-note"></i>
                                    Catatan
                                </div>
                                <div class="notes-content">{{ $transaksi->notes }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Transaction Summary -->
                    <div class="transaction-summary">
                        <h3 class="summary-title">
                            <i class="fas fa-receipt"></i>
                            Ringkasan Transaksi
                        </h3>

                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                        </div>

                        <div class="summary-row">
                            <span>Pajak (PPN 10%):</span>
                            <span>Rp {{ number_format($transaksi->tax, 0, ',', '.') }}</span>
                        </div>

                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                        </div>

                        @if($transaksi->cash_amount)
                            <div class="summary-row" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid rgba(205, 79, 184, 0.2);">
                                <span>Tunai:</span>
                                <span>Rp {{ number_format($transaksi->cash_amount, 0, ',', '.') }}</span>
                            </div>

                            <div class="summary-row">
                                <span>Kembalian:</span>
                                <span>Rp {{ number_format($transaksi->change_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            @if($transaksi->status == 'pending' || $transaksi->status == 'waiting_confirmation')
                                <button class="btn btn-konfirmasi" onclick="konfirmasiTransaksi({{ $transaksi->id }})">
                                    <i class="fas fa-check"></i> Konfirmasi Transaksi
                                </button>
                                <button class="btn btn-tolak" onclick="tolakTransaksi({{ $transaksi->id }})">
                                    <i class="fas fa-times"></i> Tolak Transaksi
                                </button>
                            @endif
                            <a href="{{ route('kasir.transaksi-pengguna') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tolak Transaksi -->
    <div id="tolakModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3 class="modal-title">Tolak Transaksi</h3>
            </div>
            <form id="tolakForm">
                <div class="form-group">
                    <label class="form-label">Alasan Penolakan:</label>
                    <textarea class="form-control" name="alasan_tolak" rows="4"
                              placeholder="Masukkan alasan penolakan transaksi..." required></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel">Batal</button>
                    <button type="submit" class="btn btn-tolak">
                        <i class="fas fa-times"></i> Tolak Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('tolakModal');
        const closeBtn = document.querySelector('.close');
        const cancelBtns = document.querySelectorAll('.btn-cancel');

        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }

        cancelBtns.forEach(btn => {
            btn.onclick = function() {
                modal.style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Konfirmasi transaksi
        function konfirmasiTransaksi(transaksiId) {
            if (confirm('Yakin ingin mengonfirmasi transaksi ini?')) {
                fetch(`/kasir/transaksi-pengguna/${transaksiId}/konfirmasi`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showToast(data.message || 'Gagal mengonfirmasi transaksi', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan sistem', 'error');
                });
            }
        }

        // Tolak transaksi
        function tolakTransaksi(transaksiId) {
            modal.style.display = 'block';
        }

        // Handle form tolak
        document.getElementById('tolakForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const alasanTolak = formData.get('alasan_tolak');

            fetch(`/kasir/transaksi-pengguna/{{ $transaksi->id }}/tolak`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    alasan_tolak: alasanTolak
                })
            })
            .then(response => response.json())
            .then(data => {
                modal.style.display = 'none';
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showToast(data.message || 'Gagal menolak transaksi', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modal.style.display = 'none';
                showToast('Terjadi kesalahan sistem', 'error');
            });
        });

        // Show toast notification
        function showToast(message, type = 'success') {
            const existingToast = document.querySelector('.toast');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 3000);
        }
    </script>
</body>
</html>
