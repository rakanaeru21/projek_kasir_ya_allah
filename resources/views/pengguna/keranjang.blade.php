<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Kasir Yaallah</title>
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
            padding: 20px 40px;
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

        /* Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Cart Items */
        .cart-items-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(221, 136, 207, 0.2);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--color-text);
        }

        .btn-clear {
            background: var(--color-error);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-clear:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(221, 136, 207, 0.1);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 8px;
            margin-right: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            flex: 1;
            margin-right: 16px;
        }

        .item-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .item-code {
            font-size: 12px;
            color: var(--color-text-muted);
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 14px;
            color: var(--color-primary);
            font-weight: 600;
        }

        .promo-info {
            background: rgba(255, 87, 34, 0.1);
            color: #FF5722;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
            margin-top: 4px;
            display: inline-block;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            margin-right: 16px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: var(--color-primary);
            color: white;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: var(--color-primary-dark);
            transform: scale(1.1);
        }

        .qty-input {
            width: 60px;
            text-align: center;
            border: 2px solid rgba(221, 136, 207, 0.3);
            background: var(--color-bg-alt);
            color: var(--color-text);
            margin: 0 12px;
            padding: 8px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
        }

        .qty-input:focus {
            outline: none;
            border-color: var(--color-primary);
        }

        .item-total {
            font-size: 16px;
            font-weight: 700;
            color: var(--color-primary);
            min-width: 100px;
            text-align: right;
            margin-right: 16px;
        }

        .remove-btn {
            background: var(--color-error);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        /* Cart Summary */
        .cart-summary {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            height: fit-content;
            position: sticky;
            top: 120px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
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

        .btn-checkout {
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

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.4);
        }

        .btn-checkout:disabled {
            background: var(--color-text-muted);
            cursor: not-allowed;
            transform: none;
        }

        .btn-continue {
            width: 100%;
            background: var(--color-bg-alt);
            color: var(--color-text);
            padding: 12px;
            border: 2px solid rgba(221, 136, 207, 0.3);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-continue:hover {
            border-color: var(--color-primary);
            background: rgba(221, 136, 207, 0.1);
            color: var(--color-text);
            text-decoration: none;
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-text-muted);
        }

        .empty-cart i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-cart h3 {
            font-size: 20px;
            margin-bottom: 8px;
            color: var(--color-text);
        }

        .empty-cart p {
            margin-bottom: 20px;
        }

        .btn-shop {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(221, 136, 207, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .navbar {
                padding: 16px 20px;
            }

            .cart-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .cart-summary {
                order: -1;
                position: static;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .item-details {
                margin-right: 0;
            }

            .quantity-controls {
                margin-right: 0;
            }

            .item-total {
                text-align: left;
                margin-right: 0;
            }
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
    <nav class="navbar">
        <h2><a href="{{ route('pengguna.dashboard') }}"><i class="fas fa-store"></i> Kasir Yaallah</a></h2>
        <div class="navbar-right">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <a href="{{ route('pengguna.produk') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Lanjut Belanja
        </a>

        <div class="page-header">
            <h1 class="page-title">Keranjang Belanja</h1>
            <p class="page-subtitle">Kelola produk yang ingin Anda beli</p>
        </div>

        @if(!empty($cart))
            <div class="cart-layout">
                <!-- Cart Items -->
                <div class="cart-items-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="fas fa-shopping-cart"></i>
                            {{ count($cart) }} Item dalam Keranjang
                        </h3>
                        <button class="btn-clear" onclick="clearCart()">
                            <i class="fas fa-trash"></i> Kosongkan
                        </button>
                    </div>

                    @foreach($cart as $key => $item)
                        <div class="cart-item" id="cart-item-{{ $key }}">
                            <div class="item-image">
                                @if($item['gambar'] && file_exists(public_path($item['gambar'])))
                                    <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama_produk'] }}">
                                @else
                                    <i class="fas fa-box"></i>
                                @endif
                            </div>

                            <div class="item-details">
                                <h4 class="item-name">{{ $item['nama_produk'] }}</h4>
                                <div class="item-code">{{ $item['kode_produk'] }}</div>
                                <div class="item-price">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    @if($item['promo_info']['has_promo'])
                                        <div class="promo-info">
                                            🎯 {{ number_format($item['promo_info']['discount_percent'], 0) }}% OFF
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="quantity-controls">
                                <button class="qty-btn" onclick="updateQuantity({{ $key }}, {{ $item['quantity'] - 1 }})">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number"
                                       class="qty-input"
                                       value="{{ $item['quantity'] }}"
                                       min="1"
                                       max="{{ $item['stok'] }}"
                                       onchange="updateQuantity({{ $key }}, this.value)">
                                <button class="qty-btn" onclick="updateQuantity({{ $key }}, {{ $item['quantity'] + 1 }})">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <div class="item-total">
                                Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                            </div>

                            <button class="remove-btn" onclick="removeItem({{ $key }})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h3 class="section-title">Ringkasan Belanja</h3>

                    <div class="summary-row">
                        <span>Subtotal ({{ count($cart) }} item):</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Pajak (PPN 10%):</span>
                        <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('pengguna.produk') }}" class="btn-continue">
                        <i class="fas fa-arrow-left"></i> Lanjut Belanja
                    </a>

                    <a href="{{ route('pengguna.checkout') }}" class="btn-checkout">
                        <i class="fas fa-credit-card"></i> Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="cart-items-section">
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Keranjang Anda Kosong</h3>
                    <p>Belum ada produk yang ditambahkan ke keranjang</p>
                    <a href="{{ route('pengguna.produk') }}" class="btn-shop">
                        <i class="fas fa-store"></i> Mulai Belanja
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Update quantity
        function updateQuantity(produkId, quantity) {
            quantity = parseInt(quantity);

            if (quantity < 0) return;

            const formData = {
                produk_id: produkId,
                quantity: quantity
            };

            fetch('{{ route("pengguna.cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (quantity === 0) {
                        // Item removed, reload page
                        location.reload();
                    } else {
                        // Update the page
                        location.reload();
                    }
                } else {
                    showToast(data.message || 'Gagal update keranjang', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Terjadi kesalahan', 'error');
            });
        }

        // Remove item
        function removeItem(produkId) {
            if (confirm('Hapus produk ini dari keranjang?')) {
                fetch(`{{ route("pengguna.cart.remove", ":id") }}`.replace(':id', produkId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        // Remove item from DOM
                        const itemElement = document.getElementById(`cart-item-${produkId}`);
                        if (itemElement) {
                            itemElement.remove();
                        }
                        // Reload page to update totals
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showToast(data.message || 'Gagal menghapus produk', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan', 'error');
                });
            }
        }

        // Clear cart
        function clearCart() {
            if (confirm('Kosongkan semua item di keranjang?')) {
                fetch('{{ route("pengguna.cart.clear") }}', {
                    method: 'POST',
                    headers: {
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
                        }, 1000);
                    } else {
                        showToast(data.message || 'Gagal mengosongkan keranjang', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan', 'error');
                });
            }
        }

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
    </script>
</body>
</html>
