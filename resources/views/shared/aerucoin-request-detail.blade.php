{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\shared\aerucoin-request-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Request AeruCoin - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .page-header {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            border-left: 6px solid var(--color-primary);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .page-header h1 {
            color: var(--color-text);
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header p {
            color: var(--color-text-muted);
            font-size: 16px;
            margin: 0;
        }

        .back-button {
            background: var(--color-bg);
            color: var(--color-text-muted);
            border: 2px solid rgba(205, 79, 184, 0.3);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .back-button:hover {
            border-color: var(--color-primary);
            color: var(--color-text);
            text-decoration: none;
        }

        .request-detail-card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
            border-left: 6px solid;
        }

        .request-detail-card.pending {
            border-left-color: var(--color-warning);
        }

        .request-detail-card.approved {
            border-left-color: var(--color-success);
        }

        .request-detail-card.rejected {
            border-left-color: var(--color-error);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(205, 79, 184, 0.2);
        }

        .request-info h2 {
            color: var(--color-text);
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .request-meta {
            color: var(--color-text-muted);
            font-size: 14px;
        }

        .status-badge {
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
            border: 2px solid var(--color-warning);
        }

        .status-badge.approved {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
            border: 2px solid var(--color-success);
        }

        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
            border: 2px solid var(--color-error);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            background: rgba(205, 79, 184, 0.1);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .detail-label {
            color: var(--color-text-muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .detail-value {
            color: var(--color-text);
            font-size: 18px;
            font-weight: 600;
        }

        .detail-value.amount {
            color: var(--color-primary-light);
            font-size: 24px;
        }

        .detail-value.balance {
            color: var(--color-success);
            font-size: 20px;
        }

        .section {
            background: rgba(255, 255, 255, 0.05);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(205, 79, 184, 0.1);
        }

        .section h3 {
            color: var(--color-text);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section p {
            color: var(--color-text-muted);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--color-bg);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .user-details h4 {
            color: var(--color-text);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .user-details p {
            color: var(--color-text-muted);
            font-size: 14px;
            margin-bottom: 2px;
        }

        .approval-section {
            border-left: 4px solid;
            padding: 20px;
            border-radius: 0 12px 12px 0;
        }

        .approval-section.approved {
            background: rgba(16, 185, 129, 0.1);
            border-left-color: var(--color-success);
        }

        .approval-section.rejected {
            background: rgba(239, 68, 68, 0.1);
            border-left-color: var(--color-error);
        }

        .approval-section h3 {
            margin-bottom: 16px;
        }

        .approval-section h3.approved {
            color: var(--color-success);
        }

        .approval-section h3.rejected {
            color: var(--color-error);
        }

        .approval-by {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .kasir-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .kasir-info h4 {
            color: var(--color-text);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .kasir-info p {
            color: var(--color-text-muted);
            font-size: 12px;
            margin: 0;
        }

        .approval-notes {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .approval-notes h5 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .approval-notes p {
            color: var(--color-text-muted);
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--color-primary);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -18px;
            top: 5px;
            width: 12px;
            height: 12px;
            background: var(--color-primary);
            border-radius: 50%;
            border: 3px solid var(--card-bg);
        }

        .timeline-item.current::before {
            background: var(--color-success);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }

        .timeline-content {
            background: var(--color-bg);
            padding: 16px;
            border-radius: 8px;
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .timeline-content h4 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .timeline-content p {
            color: var(--color-text-muted);
            font-size: 13px;
            margin: 0;
        }

        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--color-success);
            color: var(--color-success);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border-color: var(--color-error);
            color: var(--color-error);
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .request-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .user-info {
                flex-direction: column;
                text-align: center;
            }

            .approval-by {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if(Auth::user()->role == 'kasir')
            <a href="{{ route('kasir.aerucoin.requests') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Request
            </a>
        @else
            <a href="{{ route('aerucoin.request.index') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali ke Request Saya
            </a>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-file-alt"></i> Detail Request AeruCoin</h1>
            <p>Request #{{ $aerucoinRequest->id }} - {{ $aerucoinRequest->created_at->format('d M Y, H:i') }}</p>
        </div>

        <!-- Request Detail Card -->
        <div class="request-detail-card {{ $aerucoinRequest->status }}">
            <div class="request-header">
                <div class="request-info">
                    <h2>Request #{{ $aerucoinRequest->id }}</h2>
                    <div class="request-meta">
                        <i class="fas fa-calendar"></i> Dibuat: {{ $aerucoinRequest->created_at->format('d M Y, H:i') }}
                        @if($aerucoinRequest->approved_at)
                            <br><i class="fas fa-clock"></i> Diproses: {{ $aerucoinRequest->approved_at->format('d M Y, H:i') }}
                        @endif
                    </div>
                </div>
                <div class="status-badge {{ $aerucoinRequest->status }}">
                    @if($aerucoinRequest->status == 'pending')
                        <i class="fas fa-clock"></i> Menunggu Persetujuan
                    @elseif($aerucoinRequest->status == 'approved')
                        <i class="fas fa-check-circle"></i> Disetujui
                    @else
                        <i class="fas fa-times-circle"></i> Ditolak
                    @endif
                </div>
            </div>

            <!-- User Information -->
            <div class="section">
                <h3><i class="fas fa-user"></i> Informasi Pengaju</h3>
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <h4>{{ $aerucoinRequest->user->nama }}</h4>
                        <p><i class="fas fa-envelope"></i> {{ $aerucoinRequest->user->email ?? 'Email tidak tersedia' }}</p>
                        <p><i class="fas fa-phone"></i> {{ $aerucoinRequest->user->nomor_telepon }}</p>
                        <p><i class="fas fa-coins"></i> Saldo saat ini: {{ number_format($aerucoinRequest->user->aerucoin_balance, 0, ',', '.') }} AC</p>
                    </div>
                </div>
            </div>

            <!-- Request Details -->
            <div class="section">
                <h3><i class="fas fa-info-circle"></i> Detail Request</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Jumlah AeruCoin</div>
                        <div class="detail-value amount">{{ $aerucoinRequest->formatted_amount }} AC</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Uang Tunai</div>
                        <div class="detail-value">Rp {{ $aerucoinRequest->formatted_cash_amount }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            @if($aerucoinRequest->status == 'pending')
                                <span style="color: var(--color-warning);">Menunggu</span>
                            @elseif($aerucoinRequest->status == 'approved')
                                <span style="color: var(--color-success);">Disetujui</span>
                            @else
                                <span style="color: var(--color-error);">Ditolak</span>
                            @endif
                        </div>
                    </div>
                    @if($aerucoinRequest->status == 'approved')
                        <div class="detail-item">
                            <div class="detail-label">Saldo Setelah Topup</div>
                            <div class="detail-value balance">{{ number_format($aerucoinRequest->user->aerucoin_balance, 0, ',', '.') }} AC</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Request Description -->
            @if($aerucoinRequest->description)
                <div class="section">
                    <h3><i class="fas fa-comment"></i> Keterangan dari Pengaju</h3>
                    <p>{{ $aerucoinRequest->description }}</p>
                </div>
            @endif

            <!-- Approval Information -->
            @if($aerucoinRequest->status != 'pending')
                <div class="approval-section {{ $aerucoinRequest->status }}">
                    <h3 class="{{ $aerucoinRequest->status }}">
                        @if($aerucoinRequest->status == 'approved')
                            <i class="fas fa-check-circle"></i> Request Disetujui
                        @else
                            <i class="fas fa-times-circle"></i> Request Ditolak
                        @endif
                    </h3>

                    <div class="approval-by">
                        <div class="kasir-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="kasir-info">
                            <h4>{{ $aerucoinRequest->approvedBy->nama ?? 'System' }}</h4>
                            <p>Kasir • {{ $aerucoinRequest->approved_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($aerucoinRequest->approval_notes)
                        <div class="approval-notes">
                            <h5><i class="fas fa-sticky-note"></i> Catatan Kasir</h5>
                            <p>{{ $aerucoinRequest->approval_notes }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Timeline -->
            <div class="section">
                <h3><i class="fas fa-history"></i> Timeline Request</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <h4>Request Dibuat</h4>
                            <p>{{ $aerucoinRequest->created_at->format('d M Y, H:i') }} - Request penambahan {{ $aerucoinRequest->formatted_amount }} AC dibuat</p>
                        </div>
                    </div>

                    @if($aerucoinRequest->status != 'pending')
                        <div class="timeline-item current">
                            <div class="timeline-content">
                                <h4>
                                    @if($aerucoinRequest->status == 'approved')
                                        Request Disetujui
                                    @else
                                        Request Ditolak
                                    @endif
                                </h4>
                                <p>
                                    {{ $aerucoinRequest->approved_at->format('d M Y, H:i') }} -
                                    @if($aerucoinRequest->status == 'approved')
                                        Request disetujui oleh {{ $aerucoinRequest->approvedBy->nama ?? 'System' }} dan AeruCoin telah ditambahkan
                                    @else
                                        Request ditolak oleh {{ $aerucoinRequest->approvedBy->nama ?? 'System' }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="timeline-item">
                            <div class="timeline-content">
                                <h4>Menunggu Persetujuan Kasir</h4>
                                <p>Request sedang menunggu review dan persetujuan dari kasir</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
