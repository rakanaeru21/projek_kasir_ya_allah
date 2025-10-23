<!DOCTYPE html>
<html laxng="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi - Kasir Yaallah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Variables */
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
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
        }

        /* Reset & Base Styles */
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

        /* Layout Structure */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
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

        .menu-item:hover i,
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
            width: 100%;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--color-bg-alt);
        }

        /* Navbar */
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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 40px;
        }

        /* Transaction Layout */
        .transaction-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
            height: calc(100vh - 140px);
        }

        /* Product Section */
        .product-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(205, 79, 184, 0.2);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-text);
        }

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 16px;
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 8px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-muted);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            flex: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        .product-card {
            background: var(--color-bg-alt);
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-align: center;
            position: relative;
            overflow: visible;
        }

        .product-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-2px);
            background: var(--card-hover-bg);
            box-shadow: 0 4px 15px rgba(205, 79, 184, 0.2);
        }

        .product-card:hover .product-description {
            display: block !important;
        }

        .product-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 8px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .product-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--color-primary-light);
        }

        .product-stock {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-top: 4px;
        }

        /* Cart Section */
        .cart-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Cart Items */
        .cart-items {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
            max-height: 400px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(205, 79, 184, 0.1);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-info {
            flex: 1;
            margin-right: 10px;
        }

        .item-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .item-price {
            font-size: 12px;
            color: var(--color-text-muted);
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            margin: 8px 0;
        }

        .qty-btn {
            width: 25px;
            height: 25px;
            border: none;
            background: var(--color-primary);
            color: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: background 0.3s ease;
        }

        .qty-btn:hover {
            background: var(--color-primary-dark);
        }

        .qty-input {
            width: 40px;
            text-align: center;
            border: 1px solid rgba(205, 79, 184, 0.3);
            background: var(--color-bg-alt);
            color: var(--color-text);
            margin: 0 8px;
            padding: 4px;
            border-radius: 4px;
            font-size: 12px;
        }

        .item-total {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-primary-light);
            margin-left: 10px;
            min-width: 80px;
            text-align: right;
        }

        .remove-btn {
            background: var(--error-color);
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: 8px;
        }

        .remove-btn:hover {
            background: #dc2626;
        }

        /* Cart Summary */
        .cart-summary {
            border-top: 2px solid rgba(205, 79, 184, 0.2);
            padding-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary-light);
            border-top: 1px solid rgba(205, 79, 184, 0.2);
            padding-top: 10px;
            margin-top: 10px;
        }

        /* Checkout Form */
        .checkout-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
            color: var(--color-text);
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 6px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
        }

        .btn-secondary {
            background: var(--color-bg-alt);
            color: var(--color-text);
            padding: 12px 24px;
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            width: 100%;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: var(--color-primary);
            background: rgba(205, 79, 184, 0.1);
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: var(--color-text-muted);
        }

        .empty-cart i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Sidebar Overlay for Mobile */
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

        /* Responsive Design */
        @media (max-width: 1024px) {
            .transaction-layout {
                grid-template-columns: 1fr;
                gap: 20px;
                height: auto;
            }

            .cart-section {
                order: -1;
            }

            .cart-items {
                max-height: 300px;
            }
        }

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
                padding: 20px;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 10px;
            }

            .transaction-layout {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cash-register"></i> Kasir Yaallah</h2>
                <p>Kasir Panel</p>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('kasir.dashboard') }}" class="menu-item">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('kasir.transaksi') }}" class="menu-item active">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Produk</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
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
                    <button type="submit" class="btn-logout">
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
                    <h2>Transaksi Kasir</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

            <div class="container">
                <div class="transaction-layout">
                    <!-- Product Section -->
                    <div class="product-section">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-boxes"></i> Pilih Produk</h3>
                            <span class="info-badge" style="background: var(--success-color); padding: 6px 12px; border-radius: 20px; font-size: 12px;">{{ $produks->count() }} Produk</span>
                        </div>

                        <!-- Search Box -->
                        <div class="search-box">
                            <input type="text" class="search-input" placeholder="Cari nama produk, kode, atau kategori..." id="searchProduct">
                            <i class="fas fa-search search-icon"></i>
                        </div>

                        <!-- Product Grid -->
                        <div class="product-grid" id="productGrid">
                            @forelse($produks as $produk)
                                <div class="product-card" onclick="addToCart({{ $produk->id }}, '{{ $produk->nama_produk }}', {{ $produk->harga_untung }}, {{ $produk->stok }})"
                                     data-name="{{ strtolower($produk->nama_produk) }}"
                                     data-code="{{ strtolower($produk->kode_produk) }}"
                                     data-category="{{ strtolower($produk->kategori) }}">

                                    <!-- Product Image -->
                                    <div class="product-image">
                                        @if($produk->gambar && file_exists(public_path($produk->gambar)))
                                            <img src="{{ asset($produk->gambar) }}"
                                                 alt="{{ $produk->nama_produk }}"
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <i class="fas fa-box" style="display: none;"></i>
                                        @else
                                            <i class="fas fa-box"></i>
                                        @endif
                                    </div>

                                    <!-- Product Code -->
                                    <div class="product-code" style="font-size: 11px; color: var(--color-text-muted); margin-bottom: 4px;">
                                        {{ $produk->kode_produk }}
                                    </div>

                                    <!-- Product Name -->
                                    <div class="product-name" title="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</div>

                                    <!-- Product Category -->
                                    <div class="product-category" style="font-size: 11px; color: var(--color-primary-light); margin-bottom: 6px; background: rgba(205, 79, 184, 0.1); padding: 2px 6px; border-radius: 10px; display: inline-block;">
                                        {{ $produk->kategori }}
                                    </div>

                                    <!-- Price Information -->
                                    <div class="price-info" style="margin-bottom: 8px;">
                                        @if($produk->harga_normal != $produk->harga_untung)
                                            <div class="product-price-normal" style="font-size: 11px; color: var(--color-text-muted); text-decoration: line-through;">
                                                Rp {{ number_format($produk->harga_normal, 0, ',', '.') }}
                                            </div>
                                        @endif
                                        <div class="product-price">Rp {{ number_format($produk->harga_untung, 0, ',', '.') }}</div>
                                        <div class="product-unit" style="font-size: 11px; color: var(--color-text-muted);">
                                            per {{ $produk->satuan }}
                                        </div>
                                    </div>

                                    <!-- Stock Information -->
                                    <div class="stock-info" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div class="product-stock" style="font-size: 12px;">
                                            <span style="color: var(--color-text-muted);">Stok:</span>
                                            <span style="color: {{ $produk->stok > 10 ? 'var(--success-color)' : ($produk->stok > 0 ? 'var(--warning-color)' : 'var(--error-color)') }}; font-weight: 600;">
                                                {{ $produk->stok }}
                                            </span>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="status-badge" style="font-size: 10px; padding: 2px 6px; border-radius: 8px;
                                             background: {{ $produk->status == 'aktif' ? 'var(--success-color)' : 'var(--error-color)' }};
                                             color: white;">
                                            {{ ucfirst($produk->status) }}
                                        </div>
                                    </div>

                                    <!-- Hover Description (Optional) -->
                                    @if($produk->deskripsi)
                                        <div class="product-description" style="display: none; position: absolute; bottom: -10px; left: 0; right: 0; background: var(--color-bg); padding: 8px; border-radius: 6px; font-size: 11px; box-shadow: 0 2px 8px rgba(0,0,0,0.3); z-index: 10;">
                                            {{ Str::limit($produk->deskripsi, 80) }}
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-cart" style="grid-column: 1 / -1;">
                                    <i class="fas fa-box-open"></i>
                                    <p>Tidak ada produk tersedia</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Cart Section -->
                    <div class="cart-section">
                        <div class="section-header">
                            <h3 class="section-title"><i class="fas fa-shopping-cart"></i> Keranjang</h3>
                            <button class="btn-secondary" onclick="clearCart()" style="width: auto; padding: 6px 12px; margin: 0; font-size: 12px;">
                                <i class="fas fa-trash"></i> Clear
                            </button>
                        </div>

                        <!-- Cart Items -->
                        <div class="cart-items" id="cartItems">
                            <div class="empty-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <p>Keranjang masih kosong</p>
                                <small>Pilih produk untuk memulai transaksi</small>
                            </div>
                        </div>

                        <!-- Cart Summary -->
                        <div class="cart-summary" id="cartSummary" style="display: none;">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">Rp 0</span>
                            </div>
                            <div class="summary-row">
                                <span>Pajak (10%):</span>
                                <span id="tax">Rp 0</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span id="total">Rp 0</span>
                            </div>
                        </div>

                        <!-- Checkout Form -->
                        <form class="checkout-form" id="checkoutForm" style="display: none;">
                            <div class="form-group">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-input" name="customer_name" placeholder="Masukkan nama pelanggan" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-input" name="payment_method" required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="cash">Tunai</option>
                                    <option value="card">Kartu</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>

                            <div class="form-group" id="cashPaymentGroup" style="display: none;">
                                <label class="form-label">Jumlah Bayar</label>
                                <input type="number" class="form-input" name="cash_amount" placeholder="Masukkan jumlah bayar" onchange="calculateChange()">
                                <small style="color: var(--color-text-muted); font-size: 12px; margin-top: 5px; display: block;" id="changeAmount"></small>
                            </div>

                            <button type="button" class="btn-primary" onclick="processTransaction()">
                                <i class="fas fa-credit-card"></i> Proses Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Global variables
        let cart = [];
        let cartTotal = 0;

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

        // Search functionality
        document.getElementById('searchProduct').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                const productName = card.getAttribute('data-name');
                const productCode = card.getAttribute('data-code');
                const productCategory = card.getAttribute('data-category');

                if (productName.includes(searchTerm) ||
                    productCode.includes(searchTerm) ||
                    productCategory.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Add to cart function
        function addToCart(id, name, price, stock) {
            // Check if item already exists in cart
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                if (existingItem.quantity < stock) {
                    existingItem.quantity += 1;
                } else {
                    alert('Stok tidak mencukupi!');
                    return;
                }
            } else {
                if (stock > 0) {
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1,
                        stock: stock
                    });
                } else {
                    alert('Produk habis!');
                    return;
                }
            }

            updateCartDisplay();
        }

        // Update cart display
        function updateCartDisplay() {
            const cartItems = document.getElementById('cartItems');
            const cartSummary = document.getElementById('cartSummary');
            const checkoutForm = document.getElementById('checkoutForm');

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Keranjang masih kosong</p>
                        <small>Pilih produk untuk memulai transaksi</small>
                    </div>
                `;
                cartSummary.style.display = 'none';
                checkoutForm.style.display = 'none';
            } else {
                let cartHTML = '';
                let subtotal = 0;

                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;

                    cartHTML += `
                        <div class="cart-item">
                            <div class="item-info">
                                <div class="item-name">${item.name}</div>
                                <div class="item-price">Rp ${number_format(item.price)}</div>
                                <div class="quantity-controls">
                                    <button type="button" class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                                    <input type="number" class="qty-input" value="${item.quantity}" onchange="setQuantity(${index}, this.value)" min="1" max="${item.stock}">
                                    <button type="button" class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                                </div>
                            </div>
                            <div class="item-total">Rp ${number_format(itemTotal)}</div>
                            <button type="button" class="remove-btn" onclick="removeFromCart(${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                });

                cartItems.innerHTML = cartHTML;

                // Update summary
                const tax = subtotal * 0.1;
                const total = subtotal + tax;

                document.getElementById('subtotal').textContent = 'Rp ' + number_format(subtotal);
                document.getElementById('tax').textContent = 'Rp ' + number_format(tax);
                document.getElementById('total').textContent = 'Rp ' + number_format(total);

                cartTotal = total;
                cartSummary.style.display = 'block';
                checkoutForm.style.display = 'block';
            }
        }

        // Update quantity
        function updateQuantity(index, change) {
            const item = cart[index];
            const newQuantity = item.quantity + change;

            if (newQuantity <= 0) {
                removeFromCart(index);
            } else if (newQuantity <= item.stock) {
                item.quantity = newQuantity;
                updateCartDisplay();
            } else {
                alert('Stok tidak mencukupi!');
            }
        }

        // Set quantity directly
        function setQuantity(index, quantity) {
            const item = cart[index];
            const qty = parseInt(quantity);

            if (qty <= 0) {
                removeFromCart(index);
            } else if (qty <= item.stock) {
                item.quantity = qty;
                updateCartDisplay();
            } else {
                alert('Stok tidak mencukupi!');
                updateCartDisplay();
            }
        }

        // Remove from cart
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
        }

        // Clear cart
        function clearCart() {
            if (cart.length > 0) {
                if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                    cart = [];
                    updateCartDisplay();
                }
            }
        }

        // Handle payment method change
        document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
            const cashPaymentGroup = document.getElementById('cashPaymentGroup');
            if (this.value === 'cash') {
                cashPaymentGroup.style.display = 'block';
            } else {
                cashPaymentGroup.style.display = 'none';
            }
        });

        // Calculate change
        function calculateChange() {
            const cashAmount = parseFloat(document.querySelector('input[name="cash_amount"]').value) || 0;
            const changeAmount = document.getElementById('changeAmount');

            if (cashAmount >= cartTotal) {
                const change = cashAmount - cartTotal;
                changeAmount.textContent = `Kembalian: Rp ${number_format(change)}`;
                changeAmount.style.color = 'var(--success-color)';
            } else {
                changeAmount.textContent = `Kurang: Rp ${number_format(cartTotal - cashAmount)}`;
                changeAmount.style.color = 'var(--error-color)';
            }
        }

        // Process transaction
        function processTransaction() {
            if (cart.length === 0) {
                alert('Keranjang masih kosong!');
                return;
            }

            const customerName = document.querySelector('input[name="customer_name"]').value;
            const paymentMethod = document.querySelector('select[name="payment_method"]').value;

            if (!customerName || !paymentMethod) {
                alert('Harap lengkapi semua data!');
                return;
            }

            if (paymentMethod === 'cash') {
                const cashAmount = parseFloat(document.querySelector('input[name="cash_amount"]').value) || 0;
                if (cashAmount < cartTotal) {
                    alert('Jumlah bayar tidak mencukupi!');
                    return;
                }
            }

            // Here you would typically send the data to your backend
            if (confirm('Proses transaksi ini?')) {
                // Simulate transaction processing
                alert('Transaksi berhasil diproses!');

                // Reset form and cart
                cart = [];
                document.getElementById('checkoutForm').reset();
                updateCartDisplay();
            }
        }

        // Number format helper
        function number_format(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Close sidebar on window resize if desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
        });
    </script>
</body>
</html>
