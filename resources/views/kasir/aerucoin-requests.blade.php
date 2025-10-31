{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\kasir\aerucoin-requests.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Request AeruCoin - AeruStore Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS Variables and base styles (similar to previous files) */
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
            --sidebar-width: 280px;
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
            text-decoration: none;
        }

        .menu-item.active {
            background: rgba(205, 79, 184, 0.2);
            color: var(--color-text);
            border-left-color: var(--color-primary);
        }

        .menu-item:hover i {
            color: var(--color-primary-light);
        }

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

        .user-details {
            flex: 1;
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
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: var(--color-bg-alt);
        }

        /* Navbar - Top Navigation */
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

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 40px;
        }

        .page-header {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
            border-left: 6px solid var(--color-primary);
            border: 1px solid rgba(205, 79, 184, 0.2);
        }

        .page-header h1 {
            color: var(--color-text);
            margin-bottom: 16px;
            font-size: 32px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .page-header p {
            color: var(--color-text-muted);
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            border-bottom: 4px solid var(--color-primary);
            border: 1px solid rgba(205, 79, 184, 0.2);
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
            background: var(--card-hover-bg);
        }

        .stat-card.pending {
            border-bottom-color: var(--color-warning);
        }

        .stat-card.approved {
            border-bottom-color: var(--color-success);
        }

        .stat-card.rejected {
            border-bottom-color: var(--color-error);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 12px;
            display: block;
        }

        .stat-card.pending .stat-icon {
            color: var(--color-warning);
        }

        .stat-card.approved .stat-icon {
            color: var(--color-success);
        }

        .stat-card.rejected .stat-icon {
            color: var(--color-error);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: var(--color-primary-light);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-card.pending .stat-number {
            color: var(--color-warning);
        }

        .stat-card.approved .stat-number {
            color: var(--color-success);
        }

        .stat-card.rejected .stat-number {
            color: var(--color-error);
        }

        .stat-label {
            color: var(--color-text-muted);
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .requests-section {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.2);
            margin-top: 30px;
        }

        .section-title {
            color: var(--color-text);
            margin-bottom: 24px;
            font-size: 22px;
            font-weight: 600;
            border-bottom: 3px solid var(--color-primary);
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-title .left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
        }

        .filter-tab {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid;
            text-decoration: none;
        }

        .filter-tab.all {
            background: var(--color-bg);
            color: var(--color-text-muted);
            border-color: rgba(205, 79, 184, 0.3);
        }

        .filter-tab.pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
            border-color: var(--color-warning);
        }

        .filter-tab.approved {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
            border-color: var(--color-success);
        }

        .filter-tab.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
            border-color: var(--color-error);
        }

        .filter-tab:hover {
            transform: translateY(-2px);
        }

        .request-item {
            background: var(--color-bg);
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 16px;
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .request-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .request-item.pending {
            border-left-color: var(--color-warning);
        }

        .request-item.approved {
            border-left-color: var(--color-success);
        }

        .request-item.rejected {
            border-left-color: var(--color-error);
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .user-info h3 {
            color: var(--color-text);
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-info .user-details {
            color: var(--color-text-muted);
            font-size: 14px;
        }

        .request-date {
            color: var(--color-text-muted);
            font-size: 12px;
            margin-top: 4px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.2);
            color: var(--color-warning);
            border: 1px solid var(--color-warning);
        }

        .status-badge.approved {
            background: rgba(16, 185, 129, 0.2);
            color: var(--color-success);
            border: 1px solid var(--color-success);
        }

        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.2);
            color: var(--color-error);
            border: 1px solid var(--color-error);
        }

        .request-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .detail-item {
            background: rgba(205, 79, 184, 0.1);
            padding: 16px;
            border-radius: 8px;
        }

        .detail-label {
            color: var(--color-text-muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .detail-value {
            color: var(--color-text);
            font-size: 16px;
            font-weight: 600;
        }

        .detail-value.amount {
            color: var(--color-primary-light);
            font-size: 18px;
        }

        .request-description {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .request-description h4 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .request-description p {
            color: var(--color-text-muted);
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .request-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-approve {
            background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.6);
        }

        .btn-reject {
            background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.6);
        }

        .btn-detail {
            background: var(--color-bg);
            color: var(--color-text-muted);
            border: 2px solid rgba(205, 79, 184, 0.3);
        }

        .btn-detail:hover {
            border-color: var(--color-primary);
            color: var(--color-text);
        }

        .approval-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 16px;
            border-radius: 8px;
            border-left: 4px solid;
            margin-bottom: 16px;
        }

        .approval-info.approved {
            border-left-color: var(--color-success);
        }

        .approval-info.rejected {
            border-left-color: var(--color-error);
        }

        .approval-info h4 {
            color: var(--color-text);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .approval-info p {
            color: var(--color-text-muted);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .approval-info small {
            color: var(--color-text-muted);
            font-size: 12px;
        }

        .no-requests {
            text-align: center;
            padding: 60px 20px;
            color: var(--color-text-muted);
        }

        .no-requests i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
            color: var(--color-primary);
        }

        .no-requests h3 {
            font-size: 20px;
            margin-bottom: 12px;
            color: var(--color-text);
        }

        .no-requests p {
            margin-bottom: 24px;
            line-height: 1.6;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            backdrop-filter: blur(5px);
        }

        .modal-overlay.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-container {
            background: var(--card-bg);
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(205, 79, 184, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid rgba(205, 79, 184, 0.2);
            position: relative;
        }

        .modal-header.approve {
            background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
            color: white;
            border-radius: 16px 16px 0 0;
        }

        .modal-header.reject {
            background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);
            color: white;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: var(--color-text);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-textarea {
            width: 100%;
            background: var(--color-bg);
            border: 2px solid rgba(205, 79, 184, 0.3);
            border-radius: 8px;
            padding: 12px 16px;
            color: var(--color-text);
            font-size: 14px;
            transition: all 0.3s ease;
            resize: vertical;
            min-height: 100px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
        }

        .modal-footer {
            padding: 0 32px 32px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: var(--color-bg);
            color: var(--color-text-muted);
            border: 2px solid rgba(205, 79, 184, 0.3);
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            border-color: var(--color-primary);
            color: var(--color-text);
        }

        .btn-primary {
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary.approve {
            background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .btn-primary.reject {
            background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
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

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
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
                padding: 0 20px;
                margin: 24px auto;
            }

            .page-header {
                padding: 24px;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .stats-section {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .request-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .request-details {
                grid-template-columns: 1fr;
            }

            .request-actions {
                flex-direction: column;
            }

            .filter-tabs {
                flex-wrap: wrap;
            }
        }

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

        .sidebar-overlay.active {
            display: block;
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
                <a href="{{ route('kasir.transaksi') }}" class="menu-item">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span>
                </a>
                <a href="{{ route('aerucoin.index') }}" class="menu-item">
                    <i class="fas fa-coins"></i>
                    <span>Topup AeruCoin</span>
                </a>
                <a href="{{ route('kasir.aerucoin.requests') }}" class="menu-item active">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Request AeruCoin</span>
                </a>
                <a href="{{ route('kasir.transaksi-pengguna') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi Pengguna</span>
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
                    <button type="submit" class="btn-logout" style="width: 100%;">
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
                    <h2><i class="fas fa-tasks"></i> Kelola Request AeruCoin</h2>
                </div>
                <div class="navbar-right">
                    <span style="margin-right: 20px; color: var(--color-text-muted);">
                        {{ date('l, d F Y') }}
                    </span>
                </div>
            </nav>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1><i class="fas fa-tasks"></i> Kelola Request AeruCoin</h1>
            <p>Setujui atau tolak permintaan penambahan AeruCoin dari pengguna</p>
        </div>

        <!-- Statistics Section -->
        <div class="stats-section">
            <div class="stat-card pending">
                <i class="fas fa-clock stat-icon"></i>
                <div class="stat-number">{{ $pendingCount }}</div>
                <div class="stat-label">Menunggu Persetujuan</div>
            </div>
            <div class="stat-card approved">
                <i class="fas fa-check stat-icon"></i>
                <div class="stat-number">{{ $requests->where('status', 'approved')->count() }}</div>
                <div class="stat-label">Disetujui</div>
            </div>
            <div class="stat-card rejected">
                <i class="fas fa-times stat-icon"></i>
                <div class="stat-number">{{ $requests->where('status', 'rejected')->count() }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>

        <!-- Requests Section -->
        <div class="requests-section">
            <div class="section-title">
                <div class="left">
                    <i class="fas fa-list"></i> Daftar Request
                </div>
                <div class="filter-tabs">
                    <a href="{{ route('kasir.aerucoin.requests') }}" class="filter-tab all">Semua</a>
                    <a href="{{ route('kasir.aerucoin.requests', ['status' => 'pending']) }}" class="filter-tab pending">Pending</a>
                    <a href="{{ route('kasir.aerucoin.requests', ['status' => 'approved']) }}" class="filter-tab approved">Disetujui</a>
                    <a href="{{ route('kasir.aerucoin.requests', ['status' => 'rejected']) }}" class="filter-tab rejected">Ditolak</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($requests->count() > 0)
                @foreach($requests as $request)
                    <div class="request-item {{ $request->status }}">
                        <div class="request-header">
                            <div class="user-info">
                                <h3>
                                    <i class="fas fa-user"></i>
                                    {{ $request->user->nama }}
                                </h3>
                                <div class="user-details">
                                    Request #{{ $request->id }} • {{ $request->user->email ?? $request->user->nomor_telepon }}
                                </div>
                                <div class="request-date">
                                    <i class="fas fa-calendar"></i> {{ $request->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="status-badge {{ $request->status }}">
                                @if($request->status == 'pending')
                                    <i class="fas fa-clock"></i> Menunggu Persetujuan
                                @elseif($request->status == 'approved')
                                    <i class="fas fa-check"></i> Disetujui
                                @else
                                    <i class="fas fa-times"></i> Ditolak
                                @endif
                            </div>
                        </div>

                        <div class="request-details">
                            <div class="detail-item">
                                <div class="detail-label">Jumlah AeruCoin</div>
                                <div class="detail-value amount">{{ $request->formatted_amount }} AC</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Uang Tunai</div>
                                <div class="detail-value">Rp {{ $request->formatted_cash_amount }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Saldo User Saat Ini</div>
                                <div class="detail-value">{{ number_format($request->user->aerucoin_balance, 0, ',', '.') }} AC</div>
                            </div>
                            @if($request->approved_at)
                                <div class="detail-item">
                                    <div class="detail-label">Tanggal Diproses</div>
                                    <div class="detail-value">{{ $request->approved_at->format('d M Y, H:i') }}</div>
                                </div>
                            @endif
                        </div>

                        @if($request->description)
                            <div class="request-description">
                                <h4><i class="fas fa-comment"></i> Keterangan dari User</h4>
                                <p>{{ $request->description }}</p>
                            </div>
                        @endif

                        @if($request->status != 'pending')
                            <div class="approval-info {{ $request->status }}">
                                <h4>
                                    @if($request->status == 'approved')
                                        <i class="fas fa-user-check"></i> Disetujui oleh
                                    @else
                                        <i class="fas fa-user-times"></i> Ditolak oleh
                                    @endif
                                </h4>
                                <p>{{ $request->approvedBy->nama ?? 'System' }}</p>
                                @if($request->approval_notes)
                                    <p><strong>Catatan:</strong> {{ $request->approval_notes }}</p>
                                @endif
                                <small>{{ $request->approved_at->format('d M Y, H:i') }}</small>
                            </div>
                        @endif

                        <div class="request-actions">
                            @if($request->status == 'pending')
                                <button type="button" class="btn btn-approve" onclick="openApproveModal({{ $request->id }}, '{{ $request->user->nama }}', '{{ $request->formatted_amount }}')">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                                <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $request->id }}, '{{ $request->user->nama }}', '{{ $request->formatted_amount }}')">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            @endif
                            <a href="{{ route('aerucoin.request.show', $request) }}" class="btn btn-detail">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination (similar to previous page) -->
                @if($requests->hasPages())
                    <div class="pagination" style="display: flex; justify-content: center; align-items: center; gap: 8px; margin-top: 30px;">
                        @if ($requests->onFirstPage())
                            <span style="padding: 8px 12px; border-radius: 6px; background: var(--color-bg); color: var(--color-text-muted); opacity: 0.5;"><i class="fas fa-chevron-left"></i></span>
                        @else
                            <a href="{{ $requests->previousPageUrl() }}" style="padding: 8px 12px; border-radius: 6px; background: var(--color-bg); color: var(--color-text-muted); text-decoration: none; border: 1px solid rgba(205, 79, 184, 0.3);"><i class="fas fa-chevron-left"></i></a>
                        @endif

                        @foreach ($requests->getUrlRange(1, $requests->lastPage()) as $page => $url)
                            @if ($page == $requests->currentPage())
                                <span style="padding: 8px 12px; border-radius: 6px; background: var(--color-primary); color: white; border: 1px solid var(--color-primary);">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" style="padding: 8px 12px; border-radius: 6px; background: var(--color-bg); color: var(--color-text-muted); text-decoration: none; border: 1px solid rgba(205, 79, 184, 0.3);">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($requests->hasMorePages())
                            <a href="{{ $requests->nextPageUrl() }}" style="padding: 8px 12px; border-radius: 6px; background: var(--color-bg); color: var(--color-text-muted); text-decoration: none; border: 1px solid rgba(205, 79, 184, 0.3);"><i class="fas fa-chevron-right"></i></a>
                        @else
                            <span style="padding: 8px 12px; border-radius: 6px; background: var(--color-bg); color: var(--color-text-muted); opacity: 0.5;"><i class="fas fa-chevron-right"></i></span>
                        @endif
                    </div>
                @endif
            @else
                <div class="no-requests">
                    <i class="fas fa-coins"></i>
                    <h3>Tidak Ada Request</h3>
                    <p>Belum ada request penambahan AeruCoin dari pengguna.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal-overlay" id="approveModal">
        <div class="modal-container">
            <div class="modal-header approve">
                <h3><i class="fas fa-check-circle"></i> Setujui Request</h3>
                <button type="button" class="modal-close" onclick="closeModal('approveModal')">&times;</button>
            </div>

            <form id="approveForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div style="background: rgba(16, 185, 129, 0.1); padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--color-success);">
                        <h4 style="color: var(--color-success); font-size: 14px; font-weight: 600; margin-bottom: 8px;">
                            <i class="fas fa-info-circle"></i> Konfirmasi Persetujuan
                        </h4>
                        <p style="color: var(--color-text-muted); font-size: 13px; margin: 0; line-height: 1.5;">
                            Anda akan menyetujui request dari <strong id="approveUserName"></strong> untuk penambahan <strong id="approveAmount"></strong> AeruCoin.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="approve_notes" class="form-label">Catatan (Opsional)</label>
                        <textarea id="approve_notes" name="approval_notes" class="form-textarea" placeholder="Tambahkan catatan jika diperlukan" maxlength="500"></textarea>
                        <small style="color: var(--color-text-muted); font-size: 12px;">Maksimal 500 karakter</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('approveModal')">Batal</button>
                    <button type="submit" class="btn-primary approve">
                        <i class="fas fa-check"></i> Setujui Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal-overlay" id="rejectModal">
        <div class="modal-container">
            <div class="modal-header reject">
                <h3><i class="fas fa-times-circle"></i> Tolak Request</h3>
                <button type="button" class="modal-close" onclick="closeModal('rejectModal')">&times;</button>
            </div>

            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div style="background: rgba(239, 68, 68, 0.1); padding: 16px; border-radius: 8px; margin-bottom: 24px; border-left: 4px solid var(--color-error);">
                        <h4 style="color: var(--color-error); font-size: 14px; font-weight: 600; margin-bottom: 8px;">
                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Penolakan
                        </h4>
                        <p style="color: var(--color-text-muted); font-size: 13px; margin: 0; line-height: 1.5;">
                            Anda akan menolak request dari <strong id="rejectUserName"></strong> untuk penambahan <strong id="rejectAmount"></strong> AeruCoin.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="reject_notes" class="form-label">Alasan Penolakan <span style="color: var(--color-error);">*</span></label>
                        <textarea id="reject_notes" name="approval_notes" class="form-textarea" placeholder="Masukkan alasan penolakan (wajib diisi)" maxlength="500" required></textarea>
                        <small style="color: var(--color-text-muted); font-size: 12px;">Wajib diisi • Maksimal 500 karakter</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('rejectModal')">Batal</button>
                    <button type="submit" class="btn-primary reject">
                        <i class="fas fa-times"></i> Tolak Request
                    </button>
                </div>
            </form>
        </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Modal Functions
        function openApproveModal(requestId, userName, amount) {
            document.getElementById('approveUserName').textContent = userName;
            document.getElementById('approveAmount').textContent = amount + ' AC';
            document.getElementById('approveForm').action = `/kasir/aerucoin-requests/${requestId}/approve`;
            document.getElementById('approveModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function openRejectModal(requestId, userName, amount) {
            document.getElementById('rejectUserName').textContent = userName;
            document.getElementById('rejectAmount').textContent = amount + ' AC';
            document.getElementById('rejectForm').action = `/kasir/aerucoin-requests/${requestId}/reject`;
            document.getElementById('rejectModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
            document.body.style.overflow = 'auto';

            // Reset forms
            if (modalId === 'approveModal') {
                document.getElementById('approve_notes').value = '';
            } else if (modalId === 'rejectModal') {
                document.getElementById('reject_notes').value = '';
            }
        }

        // Close modal when clicking overlay
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Form submission handling
        document.getElementById('approveForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
        });

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            const notes = document.getElementById('reject_notes').value.trim();
            if (!notes) {
                e.preventDefault();
                alert('Alasan penolakan harus diisi');
                return;
            }

            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;
        });

        // Auto-refresh pending count every 30 seconds
        setInterval(function() {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newPendingCount = doc.querySelector('.stat-card.pending .stat-number');
                    if (newPendingCount) {
                        document.querySelector('.stat-card.pending .stat-number').textContent = newPendingCount.textContent;
                    }
                })
                .catch(error => console.error('Error refreshing data:', error));
        }, 30000);
    </script>
</body>
</html>
