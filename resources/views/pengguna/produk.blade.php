<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - AeruStore</title>
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

        .cart-icon {
            position: relative;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .cart-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
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
            max-width: 1400px;
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

        /* Filter Bar */
        .filter-bar {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 20px;
            align-items: center;
        }

        .search-group {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 45px 12px 16px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 8px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(221, 136, 207, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-muted);
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-select {
            padding: 10px 16px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 8px;
            background: var(--color-bg-alt);
            color: var(--color-text);
            font-size: 14px;
            min-width: 120px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        /* Product Grid */
        .products-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .products-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 20px;
        }

        .products-count {
            color: var(--color-text-muted);
            font-size: 14px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: var(--color-bg-alt);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .product-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(221, 136, 207, 0.2);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 8px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
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

        .product-category {
            display: inline-block;
            background: rgba(221, 136, 207, 0.2);
            color: var(--color-primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .product-code {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-bottom: 12px;
        }

        .price-section {
            margin-bottom: 16px;
        }

        .price-current {
            font-size: 20px;
            font-weight: 700;
            color: var(--color-primary);
        }

        .price-original {
            font-size: 14px;
            color: var(--color-text-muted);
            text-decoration: line-through;
            margin-left: 8px;
        }

        .promo-badge {
            background: linear-gradient(135deg, #FF5722 0%, #FF8A65 100%);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stock-info {
            font-size: 12px;
            color: var(--color-text-muted);
        }

        .stock-number {
            font-weight: 600;
            color: var(--color-success);
        }

        .btn-add-cart {
            width: 100%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.4);
        }

        .btn-add-cart:disabled {
            background: var(--color-text-muted);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a {
            background: var(--card-bg);
            color: var(--color-text);
            border: 1px solid rgba(221, 136, 207, 0.3);
        }

        .pagination a:hover {
            background: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }

        .pagination .active span {
            background: var(--color-primary);
            color: white;
            border: 1px solid var(--color-primary);
        }

        /* Empty State */
        .empty-products {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-text-muted);
        }

        .empty-products i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-products h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: var(--color-text);
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

            .filter-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .filter-group {
                justify-content: space-between;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }
        }

        .mobile-menu-toggle {
            display: none;
        }

        /* Toast Notification */
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
        <div class="sidebar-header">
            <h2><i class="fas fa-store"></i> AeruStore</h2>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('pengguna.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengguna.produk') }}" class="nav-item active">
                <i class="fas fa-boxes"></i>
                <span>Belanja Produk</span>
            </a>
            <a href="{{ route('pengguna.keranjang') }}" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
                <span class="cart-badge" id="sidebarCartBadge" style="display: none;">0</span>
            </a>
            <a href="{{ route('pengguna.history') }}" class="nav-item">
                <i class="fas fa-history"></i>
                <span>Riwayat Belanja</span>
            </a>
            <a href="{{ route('aerucoin.request.index') }}" class="nav-item">
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
        <a href="{{ route('pengguna.dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="page-header">
            <h1 class="page-title">Belanja Produk</h1>
            <p class="page-subtitle">Pilih produk yang ingin Anda beli dan tambahkan ke keranjang</p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <form method="GET" action="{{ route('pengguna.produk') }}" id="filterForm">
                <div class="filter-row">
                    <div class="search-group">
                        <input type="text"
                               name="search"
                               class="search-input"
                               placeholder="Cari produk, kode, atau deskripsi..."
                               value="{{ request('search') }}">
                        <i class="fas fa-search search-icon"></i>
                    </div>

                    <div class="filter-group">
                        <select name="kategori" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>

                        <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="nama_produk" {{ request('sort') == 'nama_produk' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="harga_untung" {{ request('sort') == 'harga_untung' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Section -->
        <div class="products-section">
            <div class="products-header">
                <span class="products-count">{{ $produks->total() }} produk ditemukan</span>
            </div>

            @if($produks->count() > 0)
                <div class="product-grid">
                    @foreach($produks as $produk)
                        <div class="product-card">
                            @if($produk->getActivePromoInfo()['has_promo'])
                                <div class="promo-badge">
                                    🎯 {{ number_format($produk->getActivePromoInfo()['discount_percent'], 0) }}% OFF
                                </div>
                            @endif

                            <div class="product-image">
                                @if($produk->gambar && file_exists(public_path($produk->gambar)))
                                    <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                                @else
                                    <i class="fas fa-box"></i>
                                @endif
                            </div>

                            <div class="product-category">{{ $produk->kategori }}</div>
                            <h3 class="product-name">{{ $produk->nama_produk }}</h3>
                            <div class="product-code">{{ $produk->kode_produk }}</div>

                            <div class="price-section">
                                @php $promoInfo = $produk->getActivePromoInfo(); @endphp
                                @if($promoInfo['has_promo'])
                                    <div class="price-current">Rp {{ number_format((float)$promoInfo['discounted_price'], 0, ',', '.') }}</div>
                                    <span class="price-original">Rp {{ number_format((float)$produk->harga_untung, 0, ',', '.') }}</span>
                                @else
                                    <div class="price-current">Rp {{ number_format((float)$produk->harga_untung, 0, ',', '.') }}</div>
                                @endif
                            </div>

                            <div class="product-info">
                                <div class="stock-info">
                                    Stok: <span class="stock-number">{{ $produk->stok }}</span>
                                </div>
                            </div>

                            @if($produk->deskripsi)
                                <p style="font-size: 12px; color: var(--color-text-muted); margin-bottom: 16px; line-height: 1.4;">
                                    {{ Str::limit($produk->deskripsi, 80) }}
                                </p>
                            @endif

                            <button class="btn-add-cart"
                                    onclick="addToCart({{ $produk->id }}, '{{ addslashes($produk->nama_produk) }}', {{ $produk->getFinalPrice() }}, {{ $produk->stok }})"
                                    {{ $produk->stok <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-cart-plus"></i>
                                {{ $produk->stok > 0 ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $produks->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-products">
                    <i class="fas fa-search"></i>
                    <h3>Produk tidak ditemukan</h3>
                    <p>Coba ubah kata kunci pencarian atau filter yang Anda gunakan</p>
                </div>
            @endif
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

        // Update cart badge
        function updateCartBadge() {
            fetch('{{ route("pengguna.cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cartBadge');
                    const sidebarBadge = document.getElementById('sidebarCartBadge');

                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                            badge.style.display = 'flex';
                        }
                        if (sidebarBadge) {
                            sidebarBadge.textContent = data.count;
                            sidebarBadge.style.display = 'flex';
                        }
                    } else {
                        if (badge) {
                            badge.style.display = 'none';
                        }
                        if (sidebarBadge) {
                            sidebarBadge.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error updating cart badge:', error));
        }

        // Add to cart function
        function addToCart(produkId, nama, harga, stok) {
            const button = event.target;
            const originalText = button.innerHTML;

            // Disable button
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menambah...';

            fetch('{{ route("pengguna.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    produk_id: produkId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    updateCartBadge();
                } else {
                    showToast(data.message || 'Gagal menambah produk ke keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan saat menambah produk', 'error');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }

        // Show toast notification
        function showToast(message, type = 'success') {
            // Remove existing toast
            const existingToast = document.querySelector('.toast-notification');
            if (existingToast) {
                existingToast.remove();
            }

            // Create new toast
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.background = type === 'success' ? 'var(--color-success)' : 'var(--color-error)';
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;

            document.body.appendChild(toast);

            // Show toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 3000);
        }

        // Auto-submit form on search input
        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
        });
    </script>
</body>
</html>
