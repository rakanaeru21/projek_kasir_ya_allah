<!DOCTYPE html>
<html laxng="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transaksi - AeruStore</title>
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
            user-select: none;
        }

        .product-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-2px);
            background: var(--card-hover-bg);
            box-shadow: 0 4px 15px rgba(205, 79, 184, 0.2);
        }

        .product-card:active {
            transform: translateY(0px) scale(0.98);
            box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
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
                <h2><i class="fas fa-cash-register"></i> AeruStore</h2>
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
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pengguna</span>
                    @php
                        $transaksiMenungguKonfirmasi = \App\Models\Transaksi::where('status', 'menunggu_konfirmasi')->count();
                    @endphp
                    @if($transaksiMenungguKonfirmasi > 0)
                        <span style="
                            background: linear-gradient(135deg, #ff4757, #ff3742);
                            color: white;
                            font-size: 11px;
                            font-weight: 600;
                            padding: 2px 6px;
                            border-radius: 50%;
                            margin-left: auto;
                            min-width: 18px;
                            height: 18px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            box-shadow: 0 2px 4px rgba(255, 71, 87, 0.4);
                            text-align: center;
                        ">{{ $transaksiMenungguKonfirmasi }}</span>
                    @endif
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Produk</span>
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
                                <div class="product-card"
                                    onclick="event.stopPropagation(); addToCart({{ $produk->id }}, '{{ addslashes($produk->nama_produk) }}', {{ $produk->getFinalPrice() }}, {{ $produk->stok }}, {{ json_encode($produk->getActivePromoInfo()) }})"
                                    data-product-id="{{ $produk->id }}"
                                    data-product-name="{{ $produk->nama_produk }}"
                                    data-product-price="{{ $produk->harga_untung }}"
                                    data-product-stock="{{ $produk->stok }}"
                                    data-name="{{ strtolower($produk->nama_produk) }}"
                                    data-code="{{ strtolower($produk->kode_produk) }}"
                                    data-category="{{ strtolower($produk->kategori) }}"
                                    title="Klik untuk menambahkan ke keranjang">

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

                                    <!-- Click indicator -->
                                    <div style="position: absolute; top: 8px; right: 8px; background: var(--color-primary); color: white; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; opacity: 0.8;">
                                        <i class="fas fa-plus"></i>
                                    </div>

                                    <!-- Product Category -->
                                    <div class="product-category" style="font-size: 11px; color: var(--color-primary-light); margin-bottom: 6px; background: rgba(205, 79, 184, 0.1); padding: 2px 6px; border-radius: 10px; display: inline-block;">
                                        {{ $produk->kategori }}
                                    </div>

                                    <!-- Price Information -->
                                    <div class="price-info" style="margin-bottom: 8px;">
                                        @php
                                            $produk->updateDiscountPrice();
                                            $promoInfo = $produk->getActivePromoInfo();
                                        @endphp

                                        @if($promoInfo['has_promo'])
                                            <!-- Promo Badge -->
                                            <div style="background: linear-gradient(135deg, #FF5722 0%, #FF8A65 100%); color: white; font-size: 10px; font-weight: 600; padding: 2px 6px; border-radius: 8px; margin-bottom: 4px; display: inline-block;">
                                                🎯 {{ number_format((float)$promoInfo['discount_percent'], 0) }}% OFF
                                            </div>

                                            <!-- Original Price (crossed out) -->
                                            <div class="product-price-normal" style="font-size: 11px; color: var(--color-text-muted); text-decoration: line-through;">
                                                Rp {{ number_format((float)$produk->harga_untung, 0, ',', '.') }}
                                            </div>

                                            <!-- Discounted Price -->
                                            <div class="product-price" style="color: #FF5722; font-weight: 700;">
                                                Rp {{ number_format((float)$promoInfo['discounted_price'], 0, ',', '.') }}
                                            </div>

                                            <!-- Savings -->
                                            <div style="font-size: 10px; color: #4CAF50; font-weight: 600;">
                                                Hemat Rp {{ number_format((float)$promoInfo['savings'], 0, ',', '.') }}
                                            </div>
                                        @else
                                            <!-- Normal pricing when no promo -->
                                            @if($produk->harga_normal != $produk->harga_untung)
                                                <div class="product-price-normal" style="font-size: 11px; color: var(--color-text-muted); text-decoration: line-through;">
                                                    Rp {{ number_format((float)$produk->harga_normal, 0, ',', '.') }}
                                                </div>
                                            @endif
                                            <div class="product-price">Rp {{ number_format((float)$produk->harga_untung, 0, ',', '.') }}</div>
                                        @endif

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
                                <label class="form-label">Nomor Telepon Member <small style="color: var(--color-text-muted);">(Opsional)</small></label>
                                <div style="position: relative;">
                                    <input type="text" class="form-input" name="member_phone" placeholder="Contoh: 081234567893" onchange="checkMemberPhone()" oninput="clearMemberInfo()">
                                    <div id="memberStatus" style="margin-top: 5px; font-size: 12px; display: none;">
                                        <i class="fas fa-spinner fa-spin"></i> Memeriksa member...
                                    </div>
                                    <div id="memberInfo" style="margin-top: 5px; padding: 8px; border-radius: 6px; font-size: 12px; display: none;">
                                        <!-- Member info will be displayed here -->
                                    </div>
                                </div>
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
        let isAddingToCart = false; // Debouncing flag

        // Test function to ensure JavaScript is working
        console.log('JavaScript loaded successfully!');

        // Test function - you can call this from browser console: testAddToCart()
        window.testAddToCart = function() {
            console.log('Testing addToCart function...');
            addToCart(1, 'Test Product', 5000, 10);
        };

        // Debug function to check product cards
        window.debugProductCards = function() {
            const cards = document.querySelectorAll('.product-card');
            console.log('Product cards found:', cards.length);
            cards.forEach((card, index) => {
                console.log(`Card ${index + 1}:`, {
                    onclick: card.getAttribute('onclick'),
                    productId: card.getAttribute('data-product-id'),
                    productName: card.getAttribute('data-product-name'),
                    productPrice: card.getAttribute('data-product-price'),
                    productStock: card.getAttribute('data-product-stock')
                });
            });
        };

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
        function addToCart(id, name, price, stock, promoInfo = null) {
            // Debouncing to prevent multiple rapid clicks
            if (isAddingToCart) {
                console.log('Ignoring duplicate addToCart call - debouncing');
                return;
            }

            isAddingToCart = true;

            console.log('=== addToCart called ===');
            console.log('Parameters:', { id, name, price, stock, promoInfo });
            console.log('Current cart before add:', JSON.parse(JSON.stringify(cart)));

            // Check if item already exists in cart
            const existingItem = cart.find(item => item.id === id);

            // Calculate total quantity already in cart for this product
            const totalInCart = existingItem ? existingItem.quantity : 0;
            const availableStock = stock - totalInCart;

            console.log('Stock calculation:', {
                totalInCart,
                availableStock,
                originalStock: stock
            });

            if (existingItem) {
                // Check if we can add one more
                if (availableStock > 0) {
                    existingItem.quantity += 1;
                    console.log('Item quantity updated to:', existingItem.quantity);

                    // Show confirmation feedback with promo info
                    const promoText = promoInfo && promoInfo.has_promo ? ` (🎯 ${promoInfo.discount_percent}% OFF)` : '';
                    showToast(`${name}${promoText} ditambahkan ke keranjang (${existingItem.quantity})`, 'success');
                } else {
                    showToast(`Stok tidak mencukupi! Stok tersedia: ${stock}, sudah ada ${totalInCart} di keranjang`, 'error');
                    isAddingToCart = false; // Reset flag
                    return;
                }
            } else {
                // New item
                if (stock > 0) {
                    const newItem = {
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1,
                        stock: stock,
                        promo_info: promoInfo
                    };
                    cart.push(newItem);
                    console.log('New item added to cart:', newItem);

                    // Show confirmation feedback with promo info
                    const promoText = promoInfo && promoInfo.has_promo ? ` (🎯 ${promoInfo.discount_percent}% OFF)` : '';
                    showToast(`${name}${promoText} ditambahkan ke keranjang`, 'success');
                } else {
                    showToast('Produk habis!', 'error');
                    isAddingToCart = false; // Reset flag
                    return;
                }
            }

            console.log('Cart after add:', JSON.parse(JSON.stringify(cart)));
            console.log('=== addToCart completed ===');
            updateCartDisplay();

            // Reset debouncing flag after a short delay
            setTimeout(() => {
                isAddingToCart = false;
            }, 300);
        }

        // Simple toast notification function
        function showToast(message, type = 'info') {
            // Remove existing toast
            const existingToast = document.querySelector('.toast-notification');
            if (existingToast) {
                existingToast.remove();
            }

            // Define colors based on type
            let backgroundColor;
            let iconName;

            switch(type) {
                case 'success':
                    backgroundColor = 'var(--success-color)';
                    iconName = 'check-circle';
                    break;
                case 'error':
                    backgroundColor = 'var(--error-color)';
                    iconName = 'times-circle';
                    break;
                case 'warning':
                    backgroundColor = 'var(--warning-color)';
                    iconName = 'exclamation-triangle';
                    break;
                default:
                    backgroundColor = 'var(--color-primary)';
                    iconName = 'info-circle';
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <div style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${backgroundColor};
                    color: white;
                    padding: 12px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    z-index: 9999;
                    font-size: 14px;
                    font-weight: 500;
                    max-width: 300px;
                    transform: translateX(100%);
                    transition: transform 0.3s ease;
                ">
                    <i class="fas fa-${iconName}"></i>
                    ${message}
                </div>
            `;

            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.querySelector('div').style.transform = 'translateX(0)';
            }, 100);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.querySelector('div').style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.remove();
                        }
                    }, 300);
                }
            }, 3000);
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

                    // Check if item has promo
                    const hasPromo = item.promo_info && item.promo_info.has_promo;
                    const promoText = hasPromo ? ` 🎯 ${item.promo_info.discount_percent}% OFF` : '';
                    const originalPrice = hasPromo ? item.promo_info.original_price : item.price;

                    cartHTML += `
                        <div class="cart-item">
                            <div class="item-info">
                                <div class="item-name">${item.name}${promoText}</div>
                                ${hasPromo ?
                                    `<div style="font-size: 10px; color: var(--color-text-muted); text-decoration: line-through;">
                                        Rp ${number_format(originalPrice)}
                                    </div>` :
                                    ''
                                }
                                <div class="item-price" style="color: ${hasPromo ? '#FF5722' : 'var(--color-text-muted)'};">
                                    Rp ${number_format(item.price)}
                                </div>
                                <div class="quantity-controls">
                                    <button type="button" class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                                    <input type="number" class="qty-input" value="${item.quantity}" onchange="setQuantity(${index}, this.value)" min="1" max="${item.stock}">
                                    <button type="button" class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                                </div>
                            </div>
                            <div class="item-total" style="color: ${hasPromo ? '#FF5722' : 'var(--color-primary-light)'};">
                                Rp ${number_format(itemTotal)}
                            </div>
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
                showToast(`Stok tidak mencukupi! Maksimal: ${item.stock}`, 'error');
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
                showToast(`Stok tidak mencukupi! Maksimal: ${item.stock}`, 'error');
                updateCartDisplay(); // Reset the input to current quantity
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

        // Clear member info when user is typing
        function clearMemberInfo() {
            const memberStatus = document.getElementById('memberStatus');
            const memberInfo = document.getElementById('memberInfo');
            const customerNameInput = document.querySelector('input[name="customer_name"]');

            // Hide status and info
            memberStatus.style.display = 'none';
            memberInfo.style.display = 'none';

            // Reset customer name field if it was auto-filled
            if (customerNameInput.readOnly) {
                customerNameInput.readOnly = false;
                customerNameInput.style.backgroundColor = 'var(--color-bg-alt)';
                customerNameInput.style.color = 'var(--color-text)';
                customerNameInput.value = '';
            }
        }

        // Check member phone number
        function checkMemberPhone() {
            const phoneInput = document.querySelector('input[name="member_phone"]');
            const memberStatus = document.getElementById('memberStatus');
            const memberInfo = document.getElementById('memberInfo');
            const customerNameInput = document.querySelector('input[name="customer_name"]');

            const phoneNumber = phoneInput.value.trim();

            // Hide previous status
            memberStatus.style.display = 'none';
            memberInfo.style.display = 'none';

            if (!phoneNumber) {
                return;
            }

            // Basic phone validation (must start with 08 and be 10-15 digits)
            const phoneRegex = /^08\d{8,13}$/;
            if (!phoneRegex.test(phoneNumber)) {
                memberInfo.style.display = 'block';
                memberInfo.innerHTML = `
                    <div style="background: var(--warning-color); color: white; padding: 8px; border-radius: 6px;">
                        <i class="fas fa-exclamation-triangle"></i> Format nomor telepon tidak valid
                        <br><small>Contoh format yang benar: 081234567893</small>
                    </div>
                `;
                return;
            }

            // Show loading status
            memberStatus.style.display = 'block';

            // Make AJAX request to check member
            fetch('{{ route("kasir.check-member") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: phoneNumber,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
            })
            .then(response => response.json())
            .then(data => {
                memberStatus.style.display = 'none';
                memberInfo.style.display = 'block';

                if (data.success && data.member) {
                    // Member found - show member info
                    memberInfo.innerHTML = `
                        <div style="background: var(--success-color); color: white; padding: 8px; border-radius: 6px;">
                            <i class="fas fa-check-circle"></i> Member ditemukan: <strong>${data.member.nama}</strong>
                            <br><small>Bergabung sejak: ${data.member.created_at}</small>
                        </div>
                    `;

                    // Auto-fill customer name
                    customerNameInput.value = data.member.nama;
                    customerNameInput.readOnly = true;
                    customerNameInput.style.backgroundColor = 'var(--success-color)';
                    customerNameInput.style.color = 'white';
                } else {
                    // Member not found
                    memberInfo.innerHTML = `
                        <div style="background: var(--warning-color); color: white; padding: 8px; border-radius: 6px;">
                            <i class="fas fa-exclamation-triangle"></i> Nomor telepon tidak terdaftar sebagai member
                            <br><small>Transaksi akan dilanjutkan sebagai pelanggan biasa</small>
                        </div>
                    `;

                    // Reset customer name field
                    customerNameInput.readOnly = false;
                    customerNameInput.style.backgroundColor = 'var(--color-bg-alt)';
                    customerNameInput.style.color = 'var(--color-text)';
                }
            })
            .catch(error => {
                console.error('Error checking member:', error);
                memberStatus.style.display = 'none';
                memberInfo.style.display = 'block';
                memberInfo.innerHTML = `
                    <div style="background: var(--error-color); color: white; padding: 8px; border-radius: 6px;">
                        <i class="fas fa-times-circle"></i> Gagal memeriksa data member
                        <br><small>Silakan coba lagi atau lanjutkan tanpa member</small>
                    </div>
                `;

                // Reset customer name field
                customerNameInput.readOnly = false;
                customerNameInput.style.backgroundColor = 'var(--color-bg-alt)';
                customerNameInput.style.color = 'var(--color-text)';
            });
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

            let cashAmount = 0;
            if (paymentMethod === 'cash') {
                cashAmount = parseFloat(document.querySelector('input[name="cash_amount"]').value) || 0;
                if (cashAmount < cartTotal) {
                    alert('Jumlah bayar tidak mencukupi!');
                    return;
                }
            }

            if (confirm('Proses transaksi ini?')) {
                // Disable button to prevent double submission
                const submitBtn = document.querySelector('.btn-primary');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

                // First check stock availability
                checkStockAvailability()
                .then(stockValid => {
                    if (!stockValid) {
                        throw new Error('Stok produk tidak mencukupi. Silakan periksa kembali keranjang Anda.');
                    }

                    return processTransactionRequest();
                })
                .catch(error => {
                    console.error('Transaction error:', error);
                    alert('Error: ' + error.message);
                })
                .finally(() => {
                    // Re-enable button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-credit-card"></i> Proses Pembayaran';
                });
            }
        }

        // Check stock availability before processing transaction
        function checkStockAvailability() {
            return fetch('{{ route("kasir.transaksi.check-stock") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    items: cart.map(item => ({
                        id: item.id,
                        quantity: item.quantity
                    })),
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.valid && data.errors && data.errors.length > 0) {
                    let errorMsg = 'Terdapat masalah dengan produk:\n';
                    data.errors.forEach(error => {
                        if (error.error_type === 'inactive') {
                            errorMsg += `- ${error.product_name}: ${error.message}\n`;
                        } else if (error.error_type === 'insufficient_stock') {
                            errorMsg += `- ${error.product_name}: diminta ${error.requested}, tersedia ${error.available}\n`;
                        } else {
                            errorMsg += `- ${error.product_name}: ${error.message}\n`;
                        }
                    });
                    throw new Error(errorMsg);
                }
                return data.valid;
            });
        }

        // Process transaction request
        function processTransactionRequest() {
            const customerName = document.querySelector('input[name="customer_name"]').value;
            const memberPhone = document.querySelector('input[name="member_phone"]').value;
            const paymentMethod = document.querySelector('select[name="payment_method"]').value;
            const cashAmount = paymentMethod === 'cash' ? parseFloat(document.querySelector('input[name="cash_amount"]').value) || 0 : 0;

            // Prepare transaction data
            const subtotal = cartTotal / 1.1; // Remove tax to get subtotal
            const tax = cartTotal - subtotal;

            const transactionData = {
                customer_name: customerName,
                member_phone: memberPhone || null,
                payment_method: paymentMethod,
                cash_amount: paymentMethod === 'cash' ? cashAmount : null,
                items: cart.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    price: item.price
                })),
                subtotal: subtotal,
                tax: tax,
                total_amount: cartTotal,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            console.log('Sending transaction data:', transactionData);

            // Send to backend using FormData (alternative approach)
            const formData = new FormData();
            formData.append('customer_name', transactionData.customer_name);
            formData.append('member_phone', transactionData.member_phone);
            formData.append('payment_method', transactionData.payment_method);
            formData.append('cash_amount', transactionData.cash_amount);
            formData.append('subtotal', transactionData.subtotal);
            formData.append('tax', transactionData.tax);
            formData.append('total_amount', transactionData.total_amount);
            formData.append('_token', transactionData._token);

            // Add items as JSON string or separate fields
            transactionData.items.forEach((item, index) => {
                formData.append(`items[${index}][id]`, item.id);
                formData.append(`items[${index}][quantity]`, item.quantity);
                formData.append(`items[${index}][price]`, item.price);
            });

            return fetch('{{ route("kasir.transaksi.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    // Try to get the JSON error response
                    return response.json().then(errorData => {
                        throw new Error(`HTTP ${response.status}: ${errorData.message || 'Unknown error'}`);
                    }).catch(() => {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show success message with transaction details
                    let successMessage = 'Transaksi berhasil diproses!\n';
                    successMessage += 'Kode Transaksi: ' + (data.kode_transaksi || '') + '\n';
                    successMessage += 'Total: Rp ' + number_format(data.total_amount || 0);

                    if (data.change_amount && data.change_amount > 0) {
                        successMessage += '\nKembalian: Rp ' + number_format(data.change_amount);
                    }

                    alert(successMessage);

                    // Ask if user wants to print receipt
                    if (confirm('Apakah Anda ingin mencetak struk transaksi?')) {
                        // Open print page in new window
                        window.open('/kasir/history/' + data.transaksi_id + '/print', '_blank');
                    }

                    // Reset form and cart
                    cart = [];
                    document.getElementById('checkoutForm').reset();
                    document.getElementById('changeAmount').textContent = '';

                    // Reset member info
                    document.getElementById('memberStatus').style.display = 'none';
                    document.getElementById('memberInfo').style.display = 'none';

                    // Reset customer name field style
                    const customerNameInput = document.querySelector('input[name="customer_name"]');
                    customerNameInput.readOnly = false;
                    customerNameInput.style.backgroundColor = 'var(--color-bg-alt)';
                    customerNameInput.style.color = 'var(--color-text)';

                    updateCartDisplay();

                    // Refresh product grid to update stock
                    location.reload();
                } else {
                    throw new Error(data.message || 'Transaksi gagal diproses');
                }
            });
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
            console.log('Page loaded, initializing cart...');
            updateCartDisplay();

            const productCards = document.querySelectorAll('.product-card');
            console.log('Found', productCards.length, 'product cards');

            // Only add visual feedback, not click handlers (onclick attribute handles the click)
            productCards.forEach((card, index) => {
                console.log(`Setting up visual feedback for card ${index + 1}`);

                // Add visual feedback on mouseover
                card.addEventListener('mouseenter', function() {
                    this.style.borderColor = 'var(--color-primary)';
                    this.style.transform = 'translateY(-2px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.borderColor = 'transparent';
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
