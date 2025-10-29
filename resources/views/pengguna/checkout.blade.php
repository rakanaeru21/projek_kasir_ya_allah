<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #DD88CF;
            --color-primary-light: #E6A3DC;
            --color-primary-dark: #C76BB8;
            --color-secondary: #FFE900;
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

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: var(--card-bg);
            border-right: 1px solid rgba(221, 136, 207, 0.2);
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
            border-bottom: 1px solid rgba(221, 136, 207, 0.2);
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
            background: rgba(221, 136, 207, 0.1);
            color: var(--color-text);
            text-decoration: none;
        }

        .nav-item.active {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(221, 136, 207, 0.4);
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
            border-top: 1px solid rgba(221, 136, 207, 0.2);
            background: var(--color-bg);
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            padding: 12px;
            background: rgba(221, 136, 207, 0.1);
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
            box-shadow: 0 2px 8px rgba(221, 136, 207, 0.4);
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.6);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 0;
            background: var(--color-bg-alt);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar h2 {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .navbar h2 a {
            color: white;
            text-decoration: none;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
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
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px;
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

        /* Page Header */
        .page-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: var(--color-text-muted);
            font-size: 16px;
        }

        /* Checkout Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Form Section */
        .checkout-form-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
        }

        .form-label.required::after {
            content: " *";
            color: var(--color-error);
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 8px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(221, 136, 207, 0.1);
        }

        .form-input.error {
            border-color: var(--color-error);
        }

        .form-error {
            color: var(--color-error);
            font-size: 12px;
            margin-top: 4px;
        }

        .form-textarea {
            min-height: 80px;
            resize: vertical;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .payment-option {
            position: relative;
        }

        .payment-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 12px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--color-bg-alt);
        }

        .payment-radio:checked + .payment-label {
            border-color: var(--color-primary);
            background: rgba(221, 136, 207, 0.1);
        }

        .payment-icon {
            font-size: 24px;
            margin-bottom: 8px;
            color: var(--color-primary);
        }

        .payment-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--color-text);
        }

        /* Order Summary */
        .order-summary {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            height: fit-content;
            position: sticky;
            top: 120px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(221, 136, 207, 0.1);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image-small {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 6px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            overflow: hidden;
        }

        .item-image-small img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .item-info {
            flex: 1;
        }

        .item-name-small {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .item-details-small {
            font-size: 12px;
            color: var(--color-text-muted);
        }

        .item-total-small {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-primary);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary);
            border-top: 2px solid rgba(221, 136, 207, 0.2);
            padding-top: 12px;
            margin-top: 16px;
        }

        .btn-place-order {
            width: 100%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
            margin-top: 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-place-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.4);
        }

        .btn-place-order:disabled {
            background: var(--color-text-muted);
            cursor: not-allowed;
            transform: none;
        }

        /* Loading State */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Responsive */
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

            .checkout-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .order-summary {
                order: -1;
                position: static;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }
        }

        .mobile-menu-toggle {
            display: none;
        }

        /* Toast */
        .toast-notification {
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

        .toast-notification.show {
            transform: translateX(0);
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
                <div class="navbar-left">
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
            <a href="{{ route('pengguna.keranjang') }}" class="nav-item active">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
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
                    <div class="user-name">{{ auth()->user()->nama ?? 'User' }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->role ?? 'pengguna') }}</div>
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
        <a href="{{ route('pengguna.keranjang') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
        </a>

        <div class="page-header">
            <h1 class="page-title">Checkout</h1>
            <p class="page-subtitle">Lengkapi data untuk menyelesaikan pembelian</p>
        </div>

        <div class="checkout-layout">
            <!-- Checkout Form -->
            <div class="checkout-form-section">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Informasi Pembeli
                </h3>

                <form id="checkoutForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label required">Nama Lengkap</label>
                        <input type="text"
                               name="customer_name"
                               class="form-input"
                               placeholder="Masukkan nama lengkap"
                               value="{{ auth()->user()->nama }}"
                               required>
                        <div class="form-error" id="error-customer_name"></div>
                    </div>

                    <h3 class="section-title" style="margin-top: 30px;">
                        <i class="fas fa-credit-card"></i>
                        Metode Pembayaran
                    </h3>

                    <div class="form-group">
                        <div class="payment-methods">
                            <div class="payment-option">
                                <input type="radio"
                                       id="cash"
                                       name="payment_method"
                                       value="cash"
                                       class="payment-radio"
                                       required>
                                <label for="cash" class="payment-label">
                                    <i class="fas fa-money-bill-wave payment-icon"></i>
                                    <span class="payment-name">Tunai</span>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio"
                                       id="transfer"
                                       name="payment_method"
                                       value="transfer"
                                       class="payment-radio">
                                <label for="transfer" class="payment-label">
                                    <i class="fas fa-university payment-icon"></i>
                                    <span class="payment-name">Transfer</span>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio"
                                       id="card"
                                       name="payment_method"
                                       value="card"
                                       class="payment-radio">
                                <label for="card" class="payment-label">
                                    <i class="fas fa-credit-card payment-icon"></i>
                                    <span class="payment-name">Kartu</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-error" id="error-payment_method"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes"
                                  class="form-input form-textarea"
                                  placeholder="Tambahkan catatan untuk pesanan ini"></textarea>
                        <div class="form-error" id="error-notes"></div>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="section-title">
                    <i class="fas fa-receipt"></i>
                    Ringkasan Pesanan
                </h3>

                <div class="order-items">
                    @foreach($cart as $item)
                        <div class="order-item">
                            <div class="item-image-small">
                                @if($item['gambar'] && file_exists(public_path($item['gambar'])))
                                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama_produk'] }}">
                                @else
                                    <i class="fas fa-box"></i>
                                @endif
                            </div>
                            <div class="item-info">
                                <div class="item-name-small">{{ $item['nama_produk'] }}</div>
                                <div class="item-details-small">
                                    {{ $item['quantity'] }}x @ Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    @if($item['promo_info']['has_promo'])
                                        <span style="color: #FF5722; font-weight: 600;">
                                            ({{ number_format($item['promo_info']['discount_percent'], 0) }}% OFF)
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="item-total-small">
                                Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal ({{ count($cart) }} item):</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Pajak (PPN 10%):</span>
                        <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total Pembayaran:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Info Konfirmasi -->
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; border-radius: 8px; padding: 15px; margin: 20px 0; color: #3b82f6;">
                    <div style="display: flex; align-items: center; margin-bottom: 8px;">
                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                        <strong>Informasi Penting</strong>
                    </div>
                    <p style="font-size: 13px; line-height: 1.5; margin: 0;">
                        Transaksi Anda akan diproses setelah dikonfirmasi oleh kasir.
                        Stok produk akan dikurangi setelah konfirmasi diterima.
                    </p>
                </div>

                <button type="submit"
                        form="checkoutForm"
                        class="btn-place-order"
                        id="placeOrderBtn">
                    <i class="fas fa-check-circle"></i>
                    Bayar Sekarang
                </button>
            </div>
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

        // Handle form submission
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('placeOrderBtn');
            const originalText = btn.innerHTML;

            // Clear previous errors
            document.querySelectorAll('.form-error').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-input').forEach(el => el.classList.remove('error'));

            // Disable button and show loading
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            // Send request
            fetch('{{ route("pengguna.checkout.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Transaksi berhasil diproses!', 'success');

                    // Show success message
                    const message = `
                        Transaksi berhasil dibuat!
                        Kode Transaksi: ${data.kode_transaksi}

                        Transaksi Anda sedang menunggu konfirmasi dari kasir.
                        Anda dapat melihat status transaksi di menu History.
                    `;

                    if (confirm(message + '\n\nKlik OK untuk melihat history transaksi.')) {
                        window.location.href = '{{ route("pengguna.history") }}';
                    } else {
                        window.location.href = '{{ route("pengguna.dashboard") }}';
                    }
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            const errorEl = document.getElementById(`error-${field}`);
                            const inputEl = document.querySelector(`[name="${field}"]`);

                            if (errorEl) {
                                errorEl.textContent = messages[0];
                            }
                            if (inputEl) {
                                inputEl.classList.add('error');
                            }
                        }
                    }

                    showToast(data.message || 'Terjadi kesalahan saat memproses transaksi', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan jaringan', 'error');
            })
            .finally(() => {
                // Re-enable button
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        });

        // Show toast notification
        function showToast(message, type = 'success') {
            const existingToast = document.querySelector('.toast-notification');
            if (existingToast) {
                existingToast.remove();
            }

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.background = type === 'success' ? 'var(--color-success)' : 'var(--color-error)';
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

        // Auto-fill phone number if user data exists
        document.addEventListener('DOMContentLoaded', function() {
            // You can add auto-fill logic here if needed
        });
    </script>
</body>
</html>
