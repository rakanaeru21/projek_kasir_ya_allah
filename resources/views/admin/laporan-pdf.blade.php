<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #cd4fb8;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #cd4fb8;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header h2 {
            font-size: 18px;
            color: #1B3C53;
            margin-bottom: 10px;
        }

        .header .period {
            font-size: 14px;
            color: #666;
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
        }

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1B3C53;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 2px solid #cd4fb8;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stats-row {
            display: table-row;
        }

        .stat-card {
            display: table-cell;
            width: 25%;
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
            background: #f8f9fa;
        }

        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #cd4fb8;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background: #cd4fb8;
            color: white;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        .table td {
            font-size: 10px;
        }

        .table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .table tr:hover {
            background: #e9ecef;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            color: white;
        }

        .badge-cash {
            background: #28a745;
        }

        .badge-transfer {
            background: #007bff;
        }

        .badge-card {
            background: #ffc107;
            color: #333;
        }

        .kasir-grid {
            display: table;
            width: 100%;
        }

        .kasir-row {
            display: table-row;
        }

        .kasir-card {
            display: table-cell;
            width: 50%;
            padding: 15px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            vertical-align: top;
        }

        .kasir-name {
            font-size: 12px;
            font-weight: bold;
            color: #1B3C53;
            margin-bottom: 5px;
        }

        .kasir-email {
            font-size: 9px;
            color: #666;
            margin-bottom: 10px;
        }

        .kasir-stats {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .kasir-stats .stat {
            display: table-cell;
            text-align: center;
            padding: 5px;
        }

        .kasir-stat-label {
            font-size: 8px;
            color: #666;
            text-transform: uppercase;
        }

        .kasir-stat-value {
            font-size: 12px;
            font-weight: bold;
            color: #cd4fb8;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .page-break {
            page-break-before: always;
        }

        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
            background: #f8f9fa;
            border: 1px dashed #ddd;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>🏪 AeruStore</h1>
        <h2>Laporan Penjualan Admin</h2>
        <div class="period">
            Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d F Y') }} - {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d F Y') }}
        </div>
    </div>

    <!-- Statistik Overview -->
    <div class="section">
        <div class="section-title">📊 Ringkasan Statistik</div>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">{{ number_format($statistikUmum['total_transaksi']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Pendapatan</div>
                    <div class="stat-value">Rp {{ number_format($statistikUmum['total_pendapatan'], 0, ',', '.') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Produk Terjual</div>
                    <div class="stat-value">{{ number_format($statistikUmum['total_produk_terjual']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Rata-rata Transaksi</div>
                    <div class="stat-value">Rp {{ number_format($statistikUmum['rata_rata_transaksi'], 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Per Kasir -->
    <div class="section">
        <div class="section-title">👥 Laporan Per Kasir</div>
        @if($laporanKasir->count() > 0)
            @foreach($laporanKasir->chunk(2) as $kasirChunk)
                <div class="kasir-grid">
                    <div class="kasir-row">
                        @foreach($kasirChunk as $kasir)
                        <div class="kasir-card">
                            <div class="kasir-name">{{ $kasir['nama'] }}</div>
                            <div class="kasir-email">{{ $kasir['email'] }}</div>
                            <div class="kasir-stats">
                                <div class="stat">
                                    <div class="kasir-stat-label">Transaksi</div>
                                    <div class="kasir-stat-value">{{ $kasir['jumlah_transaksi'] }}</div>
                                </div>
                                <div class="stat">
                                    <div class="kasir-stat-label">Total Penjualan</div>
                                    <div class="kasir-stat-value">Rp {{ number_format($kasir['total_penjualan'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <div style="font-size: 9px;">
                                <strong>Metode Pembayaran:</strong><br>
                                @if(count($kasir['metode_pembayaran']) > 0)
                                    @foreach($kasir['metode_pembayaran'] as $metode => $jumlah)
                                        <span class="badge badge-{{ strtolower($metode) }}">{{ ucfirst($metode) }}: {{ $jumlah }}</span>
                                    @endforeach
                                @else
                                    <em>Belum ada transaksi</em>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if($kasirChunk->count() == 1)
                            <div class="kasir-card" style="border: none; background: none;"></div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-data">Belum ada kasir yang terdaftar dalam sistem.</div>
        @endif
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <!-- Laporan Metode Pembayaran -->
    <div class="section">
        <div class="section-title">💳 Laporan Metode Pembayaran</div>
        @if($laporanPembayaran->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <th class="text-center">Jumlah Transaksi</th>
                        <th class="text-right">Total Amount</th>
                        <th class="text-center">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanPembayaran as $pembayaran)
                    <tr>
                        <td>
                            <span class="badge badge-{{ strtolower($pembayaran->payment_method) }}">
                                {{ ucfirst($pembayaran->payment_method) }}
                            </span>
                        </td>
                        <td class="text-center">{{ number_format($pembayaran->jumlah_transaksi) }}</td>
                        <td class="text-right">Rp {{ number_format($pembayaran->total_amount, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @php
                                $persentase = $statistikUmum['total_pendapatan'] > 0
                                    ? ($pembayaran->total_amount / $statistikUmum['total_pendapatan']) * 100
                                    : 0;
                            @endphp
                            {{ number_format($persentase, 1) }}%
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Belum ada transaksi dalam periode yang dipilih.</div>
        @endif
    </div>

    <!-- Laporan Produk -->
    <div class="section">
        <div class="section-title">📦 Laporan Produk</div>

        <!-- Statistik Produk -->
        <div class="stats-grid" style="margin-bottom: 20px;">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Total Produk Aktif</div>
                    <div class="stat-value">{{ number_format($laporanProduk['total_produk_aktif']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Produk Tanpa Stok</div>
                    <div class="stat-value">{{ number_format($laporanProduk['produk_tanpa_stok']) }}</div>
                </div>
                <div class="stat-card" style="border: none; background: none;"></div>
                <div class="stat-card" style="border: none; background: none;"></div>
            </div>
        </div>

        <!-- Top 10 Produk Terlaris -->
        <h4 style="margin-bottom: 10px; color: #1B3C53;">🏆 Top 10 Produk Terlaris</h4>
        @if($laporanProduk['produk_terlaris']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th class="text-right">Harga</th>
                        <th class="text-center">Total Terjual</th>
                        <th class="text-right">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporanProduk['produk_terlaris'] as $index => $produk)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $produk->produk->nama }}</td>
                        <td>{{ $produk->produk->kategori }}</td>
                        <td class="text-right">Rp {{ number_format($produk->produk->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ number_format($produk->total_terjual) }}</td>
                        <td class="text-right">Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Belum ada produk yang terjual dalam periode yang dipilih.</div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <div>Generated on {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }} | AeruStore Kasir System</div>
    </div>
</body>
</html>
