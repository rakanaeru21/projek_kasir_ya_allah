<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kasir Yaallah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #cd4fb8;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #cd4fb8;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header h2 {
            color: #666;
            font-size: 16px;
            font-weight: normal;
        }

        .periode-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #cd4fb8;
        }

        .periode-info strong {
            color: #cd4fb8;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .stat-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: top;
        }

        .stat-item:first-child {
            border-left: 3px solid #cd4fb8;
        }

        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 16px;
            color: #cd4fb8;
            font-weight: bold;
        }

        .section-title {
            color: #cd4fb8;
            font-size: 16px;
            font-weight: bold;
            margin: 25px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #cd4fb8;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th {
            background: #cd4fb8;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
        }

        .table td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }

        .table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .top-products {
            margin-top: 20px;
        }

        .product-item {
            display: table;
            width: 100%;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .product-info {
            display: table-cell;
            width: 70%;
        }

        .product-stats {
            display: table-cell;
            width: 30%;
            text-align: right;
            vertical-align: middle;
        }

        .product-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 2px;
        }

        .product-price {
            color: #666;
            font-size: 10px;
        }

        .product-quantity {
            color: #cd4fb8;
            font-weight: bold;
            font-size: 14px;
        }

        .product-revenue {
            color: #666;
            font-size: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            text-align: center;
            background: white;
        }

        .footer p {
            font-size: 10px;
            color: #666;
        }

        .empty-message {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }

        .highlight {
            background: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
        }

        @page {
            margin: 2cm 1.5cm 3cm 1.5cm;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>KASIR YAALLAH</h1>
        <h2>Laporan Penjualan</h2>
    </div>

    <!-- Periode Info -->
    <div class="periode-info">
        <strong>Periode Laporan:</strong> {{ date('d/m/Y', strtotime($tanggalMulai)) }} - {{ date('d/m/Y', strtotime($tanggalSelesai)) }}<br>
        <strong>Tanggal Cetak:</strong> {{ date('d/m/Y H:i:s') }}<br>
        <strong>Dicetak oleh:</strong> {{ auth()->user()->nama }} ({{ ucfirst(auth()->user()->role) }})
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-label">Transaksi Hari Ini</div>
            <div class="stat-value">{{ $totalTransaksiHariIni }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Penjualan Hari Ini</div>
            <div class="stat-value">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Item Terjual Hari Ini</div>
            <div class="stat-value">{{ $totalItemTerjualHariIni }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Total Periode</div>
            <div class="stat-value">Rp {{ number_format($totalPenjualanPeriode, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Transaksi Table -->
    <div class="section-title">Rincian Transaksi</div>

    @if($transaksis->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th style="width: 15%">No. Transaksi</th>
                <th style="width: 25%">Tanggal & Waktu</th>
                <th style="width: 15%" class="text-center">Total Item</th>
                <th style="width: 20%" class="text-right">Total Harga</th>
                <th style="width: 25%">Detail Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <td class="font-bold">#{{ $transaksi->id }}</td>
                <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-center">{{ $transaksi->details->sum('quantity') }} item</td>
                <td class="text-right font-bold">Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</td>
                <td>
                    @foreach($transaksi->details as $detail)
                        <div style="margin-bottom: 2px;">
                            {{ $detail->produk->nama_produk ?? 'Produk tidak ditemukan' }}
                            <span class="highlight">({{ $detail->quantity }}x)</span>
                        </div>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-message">
        Tidak ada transaksi pada periode yang dipilih.
    </div>
    @endif

    <!-- Top Products -->
    @if($produkTerlaris->count() > 0)
    <div class="section-title">5 Produk Terlaris</div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 5%" class="text-center">No</th>
                <th style="width: 35%">Nama Produk</th>
                <th style="width: 20%" class="text-right">Harga Satuan</th>
                <th style="width: 15%" class="text-center">Terjual</th>
                <th style="width: 25%" class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produkTerlaris as $index => $produk)
            <tr>
                <td class="text-center font-bold">{{ $index + 1 }}</td>
                <td class="font-bold">{{ $produk->nama_produk }}</td>
                <td class="text-right">Rp {{ number_format($produk->harga_untung, 0, ',', '.') }}</td>
                <td class="text-center font-bold" style="color: #cd4fb8;">{{ $produk->total_terjual }}</td>
                <td class="text-right font-bold">Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Summary -->
    <div class="section-title">Ringkasan Periode</div>
    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #cd4fb8;">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; border: none; padding: 5px;">
                    <strong>Total Transaksi:</strong> {{ $totalTransaksiPeriode }} transaksi
                </td>
                <td style="width: 50%; border: none; padding: 5px;">
                    <strong>Total Item Terjual:</strong> {{ $totalItemTerjualPeriode }} item
                </td>
            </tr>
            <tr>
                <td style="border: none; padding: 5px;" colspan="2">
                    <strong>Total Penjualan Periode:</strong>
                    <span style="color: #cd4fb8; font-size: 16px;">Rp {{ number_format($totalPenjualanPeriode, 0, ',', '.') }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Kasir Yaallah</strong> - Laporan Penjualan dicetak pada {{ date('d/m/Y H:i:s') }}
            <br>
            Sistem Kasir Digital - Halaman <span class="pagenum"></span>
        </p>
    </div>
</body>
</html>
