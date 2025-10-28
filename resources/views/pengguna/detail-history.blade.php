<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi {{ $transaksi->kode_transaksi }} - AeruStore</title>
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
            max-width: 1000px;
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

        /* Transaction Header */
        .transaction-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .transaction-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 8px;
        }

        .transaction-subtitle {
            color: var(--color-text-muted);
            font-size: 14px;
        }

        .transaction-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
        }

        .transaction-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .meta-label {
            font-size: 12px;
            color: var(--color-text-muted);
            font-weight: 600;
            text-transform: uppercase;
        }

        .meta-value {
            font-size: 16px;
            color: var(--color-text);
            font-weight: 600;
        }

        /* Content Layout */
        .content-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        /* Customer Info */
        .customer-info {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .info-label {
            font-size: 12px;
            color: var(--color-text-muted);
            font-weight: 600;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 14px;
            color: var(--color-text);
        }

        /* Transaction Items */
        .transaction-items {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background: var(--color-bg-alt);
            color: var(--color-text);
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(221, 136, 207, 0.2);
        }

        .items-table td {
            padding: 16px 12px;
            border-bottom: 1px solid rgba(221, 136, 207, 0.1);
            vertical-align: top;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-image {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .item-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 4px;
        }

        .item-details p {
            font-size: 12px;
            color: var(--color-text-muted);
        }

        .price-cell {
            text-align: right;
            font-weight: 600;
            color: var(--color-text);
        }

        .quantity-cell {
            text-align: center;
            font-weight: 600;
            color: var(--color-text);
        }

        .total-cell {
            text-align: right;
            font-weight: 700;
            color: var(--color-primary);
        }

        /* Summary */
        .transaction-summary {
            background: var(--color-bg-alt);
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary);
            border-top: 2px solid rgba(221, 136, 207, 0.2);
            padding-top: 12px;
            margin-top: 12px;
        }

        /* Notes */
        .transaction-notes {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .notes-content {
            background: var(--color-bg-alt);
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid var(--color-primary);
            font-style: italic;
            color: var(--color-text-muted);
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .navbar {
                padding: 16px 20px;
            }

            .header-row {
                flex-direction: column;
                gap: 16px;
            }

            .transaction-meta {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .items-table {
                font-size: 12px;
            }

            .items-table th,
            .items-table td {
                padding: 8px;
            }

            .item-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .item-image {
                width: 40px;
                height: 40px;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
                color: black;
            }

            .navbar,
            .back-button {
                display: none;
            }

            .container {
                max-width: none;
                padding: 0;
            }

            .transaction-header,
            .customer-info,
            .transaction-items,
            .transaction-notes {
                background: white;
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2><a href="{{ route('pengguna.dashboard') }}"><i class="fas fa-store"></i> AeruStore</a></h2>
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
        <a href="{{ route('pengguna.history') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
        </a>

        <!-- Transaction Header -->
        <div class="transaction-header">
            <div class="header-row">
                <div>
                    <h1 class="transaction-title">{{ $transaksi->kode_transaksi }}</h1>
                    <p class="transaction-subtitle">Detail Transaksi</p>
                </div>
                <span class="transaction-status status-{{ $transaksi->status }}">
                    @switch($transaksi->status)
                        @case('completed')
                            <i class="fas fa-check-circle"></i> Transaksi Selesai
                            @break
                        @case('pending')
                            <i class="fas fa-clock"></i> Menunggu Pembayaran
                            @break
                        @case('cancelled')
                            <i class="fas fa-times-circle"></i> Transaksi Dibatalkan
                            @break
                        @default
                            {{ ucfirst($transaksi->status) }}
                    @endswitch
                </span>
            </div>

            <div class="transaction-meta">
                <div class="meta-item">
                    <span class="meta-label">Tanggal Transaksi</span>
                    <span class="meta-value">{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Jenis Transaksi</span>
                    <span class="meta-value">
                        @if($transaksi->member_id && $transaksi->member_id == auth()->id())
                            <span style="background: var(--color-primary); color: white; padding: 4px 8px; border-radius: 8px; font-size: 12px;">
                                <i class="fas fa-user-tie"></i> Via Kasir
                            </span>
                        @else
                            <span style="background: var(--color-success); color: white; padding: 4px 8px; border-radius: 8px; font-size: 12px;">
                                <i class="fas fa-shopping-cart"></i> Belanja Online
                            </span>
                        @endif
                    </span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Metode Pembayaran</span>
                    <span class="meta-value">{{ ucfirst($transaksi->payment_method) }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Total Pembayaran</span>
                    <span class="meta-value" style="color: var(--color-primary); font-size: 20px;">
                        Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}
                    </span>
                </div>
                @if($transaksi->member_id && $transaksi->member_id == auth()->id() && $transaksi->user)
                <div class="meta-item">
                    <span class="meta-label">Dilayani oleh</span>
                    <span class="meta-value">{{ $transaksi->user->nama }} (Kasir)</span>
                </div>
                @endif
            </div>
        </div>

        <div class="content-layout">
            <!-- Customer Information -->
            <div class="customer-info">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Informasi Pelanggan
                </h3>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Pelanggan</span>
                        <span class="info-value">{{ $transaksi->customer_name ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Transaction Items -->
            <div class="transaction-items">
                <h3 class="section-title">
                    <i class="fas fa-shopping-cart"></i>
                    Item Pembelian ({{ $transaksi->details->count() }} item)
                </h3>

                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Harga Satuan</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->details as $detail)
                            <tr>
                                <td>
                                    <div class="item-info">
                                        <div class="item-image">
                                            @if($detail->produk && $detail->produk->gambar && file_exists(public_path($detail->produk->gambar)))
                                                <img src="{{ asset($detail->produk->gambar) }}" alt="{{ $detail->produk->nama_produk }}">
                                            @else
                                                <i class="fas fa-box"></i>
                                            @endif
                                        </div>
                                        <div class="item-details">
                                            <h4>{{ $detail->produk->nama_produk ?? 'Produk Dihapus' }}</h4>
                                            <p>{{ $detail->produk->kode_produk ?? '-' }}</p>
                                            @if($detail->produk && $detail->produk->kategori)
                                                <p>Kategori: {{ $detail->produk->kategori }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="quantity-cell">{{ $detail->quantity }}</td>
                                <td class="price-cell">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td class="total-cell">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Summary -->
                <div class="transaction-summary">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Pajak (PPN 10%):</span>
                        <span>Rp {{ number_format($transaksi->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Pembayaran:</span>
                        <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($transaksi->notes)
                <div class="transaction-notes">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Catatan
                    </h3>
                    <div class="notes-content">
                        {{ $transaksi->notes }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Print function (if needed)
        function printTransaction() {
            window.print();
        }

        // You can add a print button if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Add print button to page header if needed
            const headerRow = document.querySelector('.header-row');
            if (headerRow) {
                const printBtn = document.createElement('button');
                printBtn.innerHTML = '<i class="fas fa-print"></i> Cetak';
                printBtn.className = 'btn-logout';
                printBtn.style.marginLeft = '10px';
                printBtn.onclick = printTransaction;
                headerRow.appendChild(printBtn);
            }
        });
    </script>
</body>
</html>
