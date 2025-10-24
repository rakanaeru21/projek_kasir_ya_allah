<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        /* Print-specific styles */
        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }
        }

        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: white;
            max-width: 80mm;
            margin: 0 auto;
            padding: 10mm;
        }

        .receipt {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px dashed #333;
            padding-bottom: 10px;
        }

        .store-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .store-info {
            font-size: 11px;
            color: #666;
        }

        .transaction-info {
            margin-bottom: 15px;
            font-size: 11px;
        }

        .transaction-info div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .items-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .items-table th {
            text-align: left;
            border-bottom: 1px solid #333;
            padding: 3px 0;
            font-size: 11px;
            font-weight: bold;
        }

        .items-table td {
            padding: 3px 0;
            font-size: 11px;
            vertical-align: top;
        }

        .item-name {
            width: 60%;
        }

        .item-qty {
            width: 15%;
            text-align: center;
        }

        .item-price {
            width: 25%;
            text-align: right;
        }

        .subtotal-line {
            border-top: 1px solid #333;
            padding-top: 5px;
        }

        .total-section {
            border-top: 1px dashed #333;
            padding-top: 10px;
            margin-top: 10px;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 11px;
        }

        .total-line.final {
            font-weight: bold;
            font-size: 13px;
            border-top: 1px solid #333;
            padding-top: 5px;
            margin-top: 5px;
        }

        .payment-info {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #333;
            font-size: 11px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #333;
            font-size: 10px;
            color: #666;
        }

        .print-actions {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .btn-print {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-print:hover {
            background: #0056b3;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #545b62;
        }

        /* Screen only styles */
        @media screen {
            body {
                background: #f5f5f5;
                padding: 20px;
            }

            .receipt {
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                max-width: 400px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <!-- Print Actions (only visible on screen) -->
    <div class="print-actions no-print">
        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Struk
        </button>
        <a href="{{ route('kasir.history.show', $transaksi->id) }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="store-name">KASIR YAALLAH</div>
            <div class="store-info">
                Jl. Contoh Alamat No. 123<br>
                Telp: (021) 12345678<br>
                Email: info@yaallah.com
            </div>
        </div>

        <!-- Transaction Info -->
        <div class="transaction-info">
            <div>
                <span>No. Transaksi:</span>
                <span>#{{ $transaksi->id }}</span>
            </div>
            @if($transaksi->kode_transaksi)
            <div>
                <span>Kode Transaksi:</span>
                <span>{{ $transaksi->kode_transaksi }}</span>
            </div>
            @endif
            <div>
                <span>Tanggal:</span>
                <span>{{ $transaksi->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
            <div>
                <span>Kasir:</span>
                <span>{{ $transaksi->user->nama ?? 'N/A' }}</span>
            </div>
            @if($transaksi->customer_name)
            <div>
                <span>Pelanggan:</span>
                <span>{{ $transaksi->customer_name }}</span>
            </div>
            @endif
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th class="item-name">Item</th>
                    <th class="item-qty">Qty</th>
                    <th class="item-price">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->details as $detail)
                <tr>
                    <td class="item-name">
                        {{ $detail->produk->nama_produk }}<br>
                        <small style="color: #666;">@ Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</small>
                    </td>
                    <td class="item-qty">{{ $detail->quantity }}</td>
                    <td class="item-price">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total-section">
            @if($transaksi->subtotal && $transaksi->subtotal != $transaksi->total_amount)
            <div class="total-line">
                <span>Subtotal:</span>
                <span>Rp {{ number_format($transaksi->subtotal, 0, ',', '.') }}</span>
            </div>
            @endif

            @if($transaksi->tax && $transaksi->tax > 0)
            <div class="total-line">
                <span>Pajak:</span>
                <span>Rp {{ number_format($transaksi->tax, 0, ',', '.') }}</span>
            </div>
            @endif

            <div class="total-line final">
                <span>TOTAL:</span>
                <span>Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Payment Info -->
        @if($transaksi->payment_method)
        <div class="payment-info">
            <div class="total-line">
                <span>Metode Bayar:</span>
                <span>
                    @if($transaksi->payment_method == 'cash')
                        Tunai
                    @elseif($transaksi->payment_method == 'card')
                        Kartu
                    @elseif($transaksi->payment_method == 'transfer')
                        Transfer
                    @else
                        {{ ucfirst($transaksi->payment_method) }}
                    @endif
                </span>
            </div>

            @if($transaksi->cash_amount && $transaksi->cash_amount > 0)
            <div class="total-line">
                <span>Bayar:</span>
                <span>Rp {{ number_format($transaksi->cash_amount, 0, ',', '.') }}</span>
            </div>
            @endif

            @if($transaksi->change_amount && $transaksi->change_amount > 0)
            <div class="total-line">
                <span>Kembalian:</span>
                <span>Rp {{ number_format($transaksi->change_amount, 0, ',', '.') }}</span>
            </div>
            @endif
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div>Terima kasih atas kunjungan Anda!</div>
            <div>Barang yang sudah dibeli tidak dapat dikembalikan</div>
            <div style="margin-top: 10px;">
                <small>{{ date('d/m/Y H:i:s') }}</small>
            </div>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // };

        // Print function
        function printReceipt() {
            window.print();
        }

        // Back function
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
