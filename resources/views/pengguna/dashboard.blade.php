{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\pengguna\dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - AeruStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
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

/* ========================================
   Reset & Base Styles
   ======================================== */
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

/* ========================================
   Sidebar Styles
   ======================================== */
.sidebar {
    width: 280px;
    background: var(--card-bg);
    border-right: 1px solid rgba(205, 79, 184, 0.2);
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
    border-bottom: 1px solid rgba(205, 79, 184, 0.2);
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
    background: rgba(205, 79, 184, 0.1);
    color: var(--color-text);
    text-decoration: none;
}

.nav-item.active {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
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
    border-top: 1px solid rgba(205, 79, 184, 0.2);
    background: var(--color-bg);
}

.user-info {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding: 12px;
    background: rgba(205, 79, 184, 0.1);
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

/* ========================================
   Main Content Area
   ======================================== */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 0;
    background: var(--color-bg-alt);
    min-height: 100vh;
}

/* ========================================
   Container - Main Content Area
   ======================================== */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px;
}

/* ========================================
   Welcome Card - Hero Section
   ======================================== */
.welcome-card {
    background: var(--card-bg);
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: 30px;
    border-left: 6px solid var(--color-primary);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.welcome-card h1 {
    color: var(--color-text);
    margin-bottom: 16px;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.welcome-card h1 i {
    color: var(--color-primary-light);
}

.welcome-card p {
    color: var(--color-text-muted);
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

.info-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-top: 12px;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

/* ========================================
   Stats Grid - Statistics Cards
   ======================================== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(205, 79, 184, 0.2);
    border-bottom: 4px solid var(--color-primary);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.3);
    background: var(--card-hover-bg);
}

.stat-icon {
    font-size: 48px;
    margin-bottom: 16px;
    display: block;
    color: var(--color-primary-light);
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-primary-light);
    margin-bottom: 8px;
}

.stat-label {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* AeruCoin Stat Card */
.aerucoin-stat-card {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    border-bottom: 4px solid var(--color-primary-dark);
}

.aerucoin-stat-card .stat-icon {
    color: white;
}

.aerucoin-stat-card .stat-number {
    color: white;
}

.aerucoin-stat-card .stat-label {
    color: rgba(255, 255, 255, 0.9);
}

/* ========================================
   Recent Transactions
   ======================================== */
.recent-transactions {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-top: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.section-title {
    color: var(--color-text);
    margin-bottom: 24px;
    font-size: 22px;
    font-weight: 600;
    border-bottom: 3px solid var(--color-primary);
    padding-bottom: 12px;
}

.section-title i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.transaction-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
}

.transaction-item:last-child {
    border-bottom: none;
}

.transaction-info {
    display: flex;
    align-items: center;
}

.transaction-icon {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 16px;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.transaction-details h4 {
    color: var(--color-text);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
}

.transaction-details p {
    color: var(--color-text-muted);
    font-size: 12px;
}

.transaction-amount {
    color: var(--color-primary-light);
    font-weight: 700;
    font-size: 16px;
}

.no-transactions {
    text-align: center;
    color: var(--color-text-muted);
    padding: 40px 20px;
}

.no-transactions i {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
    color: var(--color-primary);
}

.view-all-link {
    text-align: center;
    margin-top: 20px;
}

.view-all-link a {
    color: var(--color-primary-light);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.view-all-link a:hover {
    color: var(--color-primary);
    text-decoration: underline;
}

/* ========================================
   AeruCoin Section
   ======================================== */
.aerucoin-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin: 30px 0;
}

.aerucoin-balance-card {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(205, 79, 184, 0.3);
    color: white;
    position: relative;
    overflow: hidden;
}

.aerucoin-balance-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.aerucoin-header {
    display: flex;
    align-items: center;
    margin-bottom: 24px;
}

.aerucoin-icon {
    background: rgba(255, 255, 255, 0.2);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 24px;
    color: white;
}

.aerucoin-info h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: white;
}

.balance-amount {
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
}

.balance-description {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
}

.aerucoin-stats {
    display: flex;
    gap: 20px;
}

.aerucoin-stat {
    display: flex;
    align-items: center;
    flex: 1;
    padding: 16px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.aerucoin-stat i {
    font-size: 20px;
    margin-right: 12px;
    color: white;
}

.stat-info {
    flex: 1;
}

.stat-value {
    font-size: 16px;
    font-weight: 700;
    color: white;
    margin-bottom: 4px;
}

.stat-name {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.aerucoin-history {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.aerucoin-transactions {
    max-height: 300px;
    overflow-y: auto;
}

.aerucoin-transaction-item {
    display: flex;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid rgba(205, 79, 184, 0.1);
}

.aerucoin-transaction-item:last-child {
    border-bottom: none;
}

.transaction-type-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 16px;
}

.transaction-type-icon.topup {
    background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
    color: white;
}

.transaction-type-icon.usage {
    background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);
    color: white;
}

.transaction-type-icon.refund {
    background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
    color: white;
}

.aerucoin-transaction-item .transaction-details {
    flex: 1;
}

.aerucoin-transaction-item .transaction-details h4 {
    color: var(--color-text);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
}

.aerucoin-transaction-item .transaction-details p {
    color: var(--color-text-muted);
    font-size: 12px;
    margin-bottom: 2px;
}

.aerucoin-transaction-item .transaction-details small {
    color: var(--color-text-muted);
    font-size: 11px;
    display: block;
}

.aerucoin-transaction-item .transaction-amount {
    font-weight: 700;
    font-size: 14px;
}

.aerucoin-transaction-item .transaction-amount.topup,
.aerucoin-transaction-item .transaction-amount.refund {
    color: var(--color-success);
}

.aerucoin-transaction-item .transaction-amount.usage {
    color: var(--color-error);
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
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

    .welcome-card {
        padding: 24px;
    }

    .welcome-card h1 {
        font-size: 24px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .transaction-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .transaction-amount {
        align-self: flex-end;
    }

    /* AeruCoin Mobile Responsive */
    .aerucoin-section {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .aerucoin-header {
        flex-direction: column;
        text-align: center;
        margin-bottom: 20px;
    }

    .aerucoin-icon {
        margin-right: 0;
        margin-bottom: 12px;
    }

    .aerucoin-stats {
        flex-direction: column;
        gap: 12px;
    }

    .aerucoin-transaction-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
    }

    .aerucoin-transaction-item .transaction-amount {
        align-self: flex-end;
        margin-top: 8px;
    }

    .balance-amount {
        font-size: 24px;
    }
}

.mobile-menu-toggle {
    display: none;
}

/* ========================================
   Request AeruCoin Button & Modal Styles
   ======================================== */
.btn-request-aerucoin {
    width: 100%;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-request-aerucoin:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
}

.btn-request-aerucoin i {
    font-size: 16px;
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
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    padding: 24px;
    border-radius: 16px 16px 0 0;
    position: relative;
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

.form-input {
    width: 100%;
    background: var(--color-bg);
    border: 2px solid rgba(205, 79, 184, 0.3);
    border-radius: 8px;
    padding: 12px 16px;
    color: var(--color-text);
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(205, 79, 184, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 80px;
}

.form-info {
    background: rgba(205, 79, 184, 0.1);
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
    border-left: 4px solid var(--color-primary);
}

.form-info h4 {
    color: var(--color-primary-light);
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

.form-info p {
    color: var(--color-text-muted);
    font-size: 13px;
    margin: 0;
    line-height: 1.5;
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
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.6);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
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

.pending-requests-section {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-top: 30px;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

.request-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    background: var(--color-bg);
    border-radius: 8px;
    margin-bottom: 12px;
    border-left: 4px solid var(--color-warning);
}

.request-item:last-child {
    margin-bottom: 0;
}

.request-details h4 {
    color: var(--color-text);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

.request-details p {
    color: var(--color-text-muted);
    font-size: 13px;
    margin-bottom: 4px;
}

.request-amount {
    color: var(--color-primary-light);
    font-weight: 700;
    font-size: 18px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-pending {
    background: rgba(245, 158, 11, 0.2);
    color: var(--color-warning);
    border: 1px solid var(--color-warning);
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
            <a href="{{ route('pengguna.dashboard') }}" class="nav-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('pengguna.produk') }}" class="nav-item">
                <i class="fas fa-boxes"></i>
                <span>Belanja Produk</span>
            </a>
            <a href="{{ route('pengguna.keranjang') }}" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
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
                    <div class="user-name">{{ $user->nama }}</div>
                    <div class="user-role">{{ ucfirst($user->role) }}</div>
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
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h1><i class="fas fa-hand-wave"></i> Selamat Datang, {{ $user->nama }}!</h1>
            <p>Selamat berbelanja di AeruStore. Nikmati pengalaman belanja yang mudah dan menyenangkan.</p>
            <span class="info-badge"><i class="fas fa-check-circle"></i> {{ ucfirst($user->role) }}</span>
        </div>

        <!-- Statistics Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-receipt stat-icon"></i>
                <div class="stat-number">{{ $totalTransaksi }}</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-money-bill-wave stat-icon"></i>
                <div class="stat-number">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</div>
                <div class="stat-label">Total Belanja</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shopping-cart stat-icon"></i>
                <div class="stat-number">{{ $cartCount }}</div>
                <div class="stat-label">Item di Keranjang</div>
            </div>
            <div class="stat-card aerucoin-stat-card">
                <i class="fas fa-coins stat-icon"></i>
                <div class="stat-number">{{ number_format($aerucoinBalance, 0, ',', '.') }} AC</div>
                <div class="stat-label">Saldo AeruCoin</div>
            </div>
        </div>

        <!-- AeruCoin Section -->
        <div class="aerucoin-section">
            <div class="aerucoin-balance-card">
                <div class="aerucoin-header">
                    <div class="aerucoin-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="aerucoin-info">
                        <h3>Saldo AeruCoin</h3>
                        <div class="balance-amount">{{ number_format($aerucoinBalance, 0, ',', '.') }} AC</div>
                        <p class="balance-description">Gunakan AeruCoin untuk pembayaran yang lebih mudah</p>
                    </div>
                </div>

                <div class="aerucoin-stats">
                    <div class="aerucoin-stat">
                        <i class="fas fa-arrow-up"></i>
                        <div class="stat-info">
                            <div class="stat-value">{{ number_format($totalTopup, 0, ',', '.') }} AC</div>
                            <div class="stat-name">Total Top Up</div>
                        </div>
                    </div>
                    <div class="aerucoin-stat">
                        <i class="fas fa-arrow-down"></i>
                        <div class="stat-info">
                            <div class="stat-value">{{ number_format($totalUsage, 0, ',', '.') }} AC</div>
                            <div class="stat-name">Total Penggunaan</div>
                        </div>
                    </div>
                </div>

                <!-- Request AeruCoin Button -->
                <div style="margin-top: 20px;">
                    <button type="button" class="btn-request-aerucoin" data-bs-toggle="modal" data-bs-target="#requestAeruCoinModal">
                        <i class="fas fa-plus-circle"></i> Request Tambah AeruCoin
                    </button>
                </div>
            </div>

            <!-- Riwayat AeruCoin -->
            <div class="aerucoin-history">
                <h3 class="section-title"><i class="fas fa-history"></i> Riwayat AeruCoin Terbaru</h3>

                @if($aerucoinTransactionsTerbaru->count() > 0)
                    <div class="aerucoin-transactions">
                        @foreach($aerucoinTransactionsTerbaru as $transaction)
                            <div class="aerucoin-transaction-item">
                                <div class="transaction-type-icon {{ $transaction->type }}">
                                    @if($transaction->type == 'topup')
                                        <i class="fas fa-plus"></i>
                                    @elseif($transaction->type == 'usage')
                                        <i class="fas fa-minus"></i>
                                    @else
                                        <i class="fas fa-undo"></i>
                                    @endif
                                </div>
                                <div class="transaction-details">
                                    <h4>
                                        @if($transaction->type == 'topup')
                                            Top Up AeruCoin
                                        @elseif($transaction->type == 'usage')
                                            Penggunaan AeruCoin
                                        @else
                                            Refund AeruCoin
                                        @endif
                                    </h4>
                                    <p>{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                                    @if($transaction->description)
                                        <small>{{ $transaction->description }}</small>
                                    @endif
                                    @if($transaction->kasir)
                                        <small>Oleh: {{ $transaction->kasir->nama }}</small>
                                    @endif
                                </div>
                                <div class="transaction-amount {{ $transaction->type }}">
                                    @if($transaction->type == 'topup' || $transaction->type == 'refund')
                                        +{{ number_format($transaction->amount, 0, ',', '.') }} AC
                                    @else
                                        -{{ number_format($transaction->amount, 0, ',', '.') }} AC
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-transactions">
                        <i class="fas fa-coins"></i>
                        <p>Belum ada transaksi AeruCoin</p>
                        <small>Minta kasir untuk melakukan top up AeruCoin</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pending AeruCoin Requests Section -->
        @if($pendingRequests->count() > 0)
            <div class="pending-requests-section">
                <h2 class="section-title"><i class="fas fa-clock"></i> Request AeruCoin Menunggu Persetujuan</h2>

                @foreach($pendingRequests as $request)
                    <div class="request-item">
                        <div class="request-details">
                            <h4>Request #{{ $request->id }}</h4>
                            <p>{{ $request->formatted_amount }} AC • Rp {{ $request->formatted_cash_amount }}</p>
                            <p style="font-size: 12px;">{{ $request->created_at->format('d M Y, H:i') }}</p>
                            @if($request->description)
                                <p style="font-size: 12px; margin-top: 4px;">{{ Str::limit($request->description, 50) }}</p>
                            @endif
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                            <div class="status-badge status-pending">
                                <i class="fas fa-clock"></i> Pending
                            </div>
                            <div class="request-amount">{{ $request->formatted_amount }} AC</div>
                        </div>
                    </div>
                @endforeach

                <div class="view-all-link">
                    <a href="{{ route('aerucoin.request.index') }}">
                        <i class="fas fa-arrow-right"></i> Lihat Semua Request
                    </a>
                </div>
            </div>
        @endif

        <!-- Recent Transactions -->
        <div class="recent-transactions">
            <h2 class="section-title"><i class="fas fa-clock"></i> Transaksi Terbaru</h2>

            @if($transaksiTerbaru->count() > 0)
                @foreach($transaksiTerbaru as $transaksi)
                    <div class="transaction-item">
                        <div class="transaction-info">
                            <div class="transaction-icon">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="transaction-details">
                                <h4>{{ $transaksi->kode_transaksi }}</h4>
                                <p>{{ $transaksi->created_at->format('d M Y, H:i') }} • {{ ucfirst($transaksi->payment_method) }}</p>
                            </div>
                        </div>
                        <div class="transaction-amount">
                            Rp {{ number_format($transaksi->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div class="view-all-link">
                    <a href="{{ route('pengguna.history') }}">
                        <i class="fas fa-arrow-right"></i> Lihat Semua Transaksi
                    </a>
                </div>
            @else
                <div class="no-transactions">
                    <i class="fas fa-receipt"></i>
                    <p>Belum ada transaksi</p>
                    <small>Mulai berbelanja untuk melihat riwayat transaksi</small>
                </div>
            @endif
        </div>
    </div>

    <!-- Request AeruCoin Modal -->
    <div class="modal-overlay" id="requestAeruCoinModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle"></i> Request Tambah AeruCoin</h3>
                <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <form action="{{ route('aerucoin.request.store') }}" method="POST" id="requestForm">
                @csrf
                <div class="modal-body">
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

                    <div class="form-info">
                        <h4><i class="fas fa-info-circle"></i> Informasi Penting</h4>
                        <p>Request penambahan AeruCoin akan diperiksa dan disetujui oleh kasir. Pastikan Anda menyiapkan uang tunai sesuai dengan jumlah yang diminta.</p>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah AeruCoin (AC)</label>
                        <input type="number"
                               id="amount"
                               name="amount"
                               class="form-input"
                               placeholder="Masukkan jumlah AeruCoin"
                               min="1000"
                               max="1000000"
                               step="1000"
                               required>
                        <small style="color: var(--color-text-muted); font-size: 12px;">Minimal 1.000 AC, Maksimal 1.000.000 AC</small>
                    </div>

                    <div class="form-group">
                        <label for="cash_amount" class="form-label">Jumlah Uang Tunai (Rp)</label>
                        <input type="number"
                               id="cash_amount"
                               name="cash_amount"
                               class="form-input"
                               placeholder="Masukkan jumlah uang tunai"
                               min="1000"
                               max="1000000"
                               step="1000"
                               required>
                        <small style="color: var(--color-text-muted); font-size: 12px;">Jumlah uang tunai yang akan Anda setor ke kasir</small>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Keterangan (Opsional)</label>
                        <textarea id="description"
                                  name="description"
                                  class="form-input form-textarea"
                                  placeholder="Tambahkan keterangan jika diperlukan"
                                  maxlength="500"></textarea>
                        <small style="color: var(--color-text-muted); font-size: 12px;">Maksimal 500 karakter</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Functions
        function openModal() {
            document.getElementById('requestAeruCoinModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('requestAeruCoinModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Open modal when button clicked
        document.querySelector('.btn-request-aerucoin').addEventListener('click', openModal);

        // Close modal when clicking overlay
        document.getElementById('requestAeruCoinModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Auto-fill cash amount based on AeruCoin amount (1:1 ratio)
        document.getElementById('amount').addEventListener('input', function() {
            document.getElementById('cash_amount').value = this.value;
        });

        // Form validation
        document.getElementById('requestForm').addEventListener('submit', function(e) {
            const amount = parseInt(document.getElementById('amount').value);
            const cashAmount = parseInt(document.getElementById('cash_amount').value);

            if (amount < 1000 || amount > 1000000) {
                e.preventDefault();
                alert('Jumlah AeruCoin harus antara 1.000 - 1.000.000 AC');
                return;
            }

            if (cashAmount < 1000 || cashAmount > 1000000) {
                e.preventDefault();
                alert('Jumlah uang tunai harus antara Rp 1.000 - Rp 1.000.000');
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            submitBtn.disabled = true;
        });
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

        // Update cart badge secara real-time
        function updateCartBadge() {
            fetch('{{ route("pengguna.cart.count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.querySelector('.nav-item .cart-badge');
                    const cartNavItem = document.querySelector('.nav-item[href*="keranjang"]');

                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                        } else {
                            cartNavItem.innerHTML += `<span class="cart-badge">${data.count}</span>`;
                        }
                    } else {
                        if (badge) {
                            badge.remove();
                        }
                    }
                })
                .catch(error => console.error('Error updating cart badge:', error));
        }

        // Update cart badge saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();

            // Update setiap 30 detik
            setInterval(updateCartBadge, 30000);
        });
    </script>
</body>
</html>
