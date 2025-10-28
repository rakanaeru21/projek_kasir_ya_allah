<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeruStore - Solusi Kasir Digital Terdepan</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <style>
        /* CSS Variables */
        :root {
            --primary-color: #cd4fb8;
            --primary-light: #e377d0;
            --primary-dark: #a63d94;
            --secondary-color: #667eea;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --white: #ffffff;
            --light-bg: #f7fafc;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --error-color: #f56565;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-heavy: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            text-align: center;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: var(--shadow-light);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-accent {
            background: var(--gradient-secondary);
            color: var(--white);
            box-shadow: var(--shadow-light);
        }

        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(205, 79, 184, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .header.scrolled {
            box-shadow: var(--shadow-light);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
        }

        .logo i {
            font-size: 28px;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--primary-color);
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>') no-repeat center/cover;
            opacity: 0.3;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-text .highlight {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 20px;
            box-shadow: var(--shadow-heavy);
            transform: rotate(3deg);
            transition: transform 0.3s ease;
        }

        .hero-image:hover {
            transform: rotate(0deg) scale(1.05);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Stats Section */
        .stats {
            background: var(--white);
            padding: 4rem 0;
            position: relative;
            z-index: 3;
            margin-top: -50px;
            border-radius: 20px 20px 0 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            background: var(--light-bg);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: var(--text-light);
            font-weight: 500;
        }

        /* Features Section */
        .features {
            padding: 6rem 0;
            background: var(--light-bg);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-secondary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Products Section */
        .products {
            padding: 6rem 0;
            background: var(--white);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        .product-image {
            height: 200px;
            background: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--primary-color);
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Promos Section */
        .promos {
            padding: 6rem 0;
            background: var(--light-bg);
        }

        .promos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .promo-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .promo-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
        }

        .promo-card:hover::before {
            animation: shine 0.6s ease-in-out;
        }

        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-medium);
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .promo-badge {
            background: var(--gradient-secondary);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .promo-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .promo-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .promo-discount {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* CTA Section */
        .cta {
            padding: 6rem 0;
            background: var(--gradient-primary);
            color: var(--white);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="b" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.05"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="100" cy="100" r="50" fill="url(%23b)"/><circle cx="900" cy="200" r="80" fill="url(%23b)"/><circle cx="300" cy="800" r="60" fill="url(%23b)"/><circle cx="700" cy="600" r="90" fill="url(%23b)"/></svg>') no-repeat center/cover;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .cta p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .cta-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-white {
            background: var(--white);
            color: var(--primary-color);
            font-weight: 600;
        }

        .btn-white:hover {
            background: var(--light-bg);
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: var(--white);
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-light);
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin-bottom: 0.5rem;
            display: block;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--primary-light);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background: var(--white);
                flex-direction: column;
                padding: 5rem 2rem 2rem;
                box-shadow: var(--shadow-medium);
                transition: right 0.3s ease;
            }

            .nav-menu.active {
                right: 0;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta h2 {
                font-size: 2rem;
            }

            .stats {
                margin-top: 0;
                border-radius: 0;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text p {
                font-size: 1.1rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .feature-card,
            .product-card,
            .promo-card {
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid var(--light-bg);
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div class="loading" id="loading">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="#" class="logo">
                    <i class="fas fa-cash-register"></i>
                    <span>AeruStore</span>
                </a>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#fitur">Fitur</a></li>
                    <li><a href="#produk">Produk</a></li>
                    <li><a href="#promo">Promo</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <li><a href="{{ route('login') }}" class="btn btn-primary">Masuk</a></li>
                </ul>

                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text" data-aos="fade-right">
                    <h1>Solusi <span class="highlight">Kasir Digital</span> Terdepan untuk Bisnis Anda</h1>
                    <p>AeruStore menghadirkan sistem kasir modern yang mudah digunakan, lengkap dengan manajemen produk, promo, dan laporan penjualan yang komprehensif. Tingkatkan efisiensi bisnis Anda hari ini!</p>
                    <div class="hero-actions">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Mulai Sekarang
                        </a>
                        <a href="#fitur" class="btn btn-secondary">
                            <i class="fas fa-play-circle"></i>
                            Lihat Demo
                        </a>
                    </div>
                </div>

                <div class="hero-visual" data-aos="fade-left">
                    <div class="floating-elements">
                        <div class="floating-element"></div>
                        <div class="floating-element"></div>
                        <div class="floating-element"></div>
                    </div>
                    <!-- Placeholder for hero image -->
                    <div style="width: 100%; max-width: 500px; height: 400px; background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3);">
                        <i class="fas fa-cash-register" style="font-size: 120px; color: rgba(255,255,255,0.8);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="stat-number">{{ $totalProducts }}+</div>
                    <div class="stat-label">Produk Tersedia</div>
                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="stat-number">{{ $totalTransactions }}+</div>
                    <div class="stat-label">Transaksi Berhasil</div>
                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Pengguna Aktif</div>
                </div>

                <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Kepuasan Pelanggan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fitur">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Fitur Unggulan AeruStore</h2>
                <p class="section-subtitle">Sistem kasir lengkap dengan berbagai fitur canggih untuk mendukung operasional bisnis Anda</p>
            </div>

            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <h3 class="feature-title">Kasir Digital</h3>
                    <p class="feature-description">Interface kasir yang user-friendly dengan proses checkout yang cepat dan efisien. Mendukung berbagai metode pembayaran.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h3 class="feature-title">Manajemen Produk</h3>
                    <p class="feature-description">Kelola inventori produk dengan mudah, termasuk stok, harga, kategori, dan gambar produk secara real-time.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <h3 class="feature-title">Sistem Promo</h3>
                    <p class="feature-description">Buat dan kelola berbagai jenis promo dan diskon untuk meningkatkan penjualan dan loyalitas pelanggan.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Laporan Penjualan</h3>
                    <p class="feature-description">Dashboard analitik lengkap dengan laporan penjualan, grafik trend, dan insight bisnis yang actionable.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Multi User</h3>
                    <p class="feature-description">Sistem role-based access untuk admin, kasir, dan pelanggan dengan permission yang dapat dikustomisasi.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <h3 class="feature-title">Cetak Struk</h3>
                    <p class="feature-description">Cetak struk pembelian secara otomatis dengan desain profesional dan informasi transaksi yang lengkap.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    @if($featuredProducts->count() > 0)
    <section class="products" id="produk">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Produk Unggulan</h2>
                <p class="section-subtitle">Temukan berbagai produk berkualitas dengan harga terbaik</p>
            </div>

            <div class="products-grid">
                @foreach($featuredProducts as $product)
                <div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="product-image">
                        @if($product->gambar && file_exists(public_path($product->gambar)))
                            <img src="{{ asset($product->gambar) }}" alt="{{ $product->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-box"></i>
                        @endif
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $product->nama_produk }}</h3>
                        <div class="product-price">Rp {{ number_format($product->getFinalPrice(), 0, ',', '.') }}</div>
                        <p class="product-description">{{ Str::limit($product->deskripsi ?? 'Produk berkualitas tinggi', 60) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 3rem;" data-aos="fade-up">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i>
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Promos Section -->
    @if($activePromos->count() > 0)
    <section class="promos" id="promo">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Promo Menarik</h2>
                <p class="section-subtitle">Jangan lewatkan penawaran terbaik kami bulan ini</p>
            </div>

            <div class="promos-grid">
                @foreach($activePromos as $promo)
                <div class="promo-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="promo-badge">🔥 Promo Hot</div>
                    <h3 class="promo-title">{{ $promo->nama }}</h3>
                    <p class="promo-description">{{ $promo->deskripsi }}</p>
                    <div class="promo-discount">{{ number_format($promo->diskon, 0) }}% OFF</div>
                    <small style="color: var(--text-light);">
                        Berlaku hingga {{ \Carbon\Carbon::parse($promo->berakhir)->format('d M Y') }}
                    </small>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2>Siap Memulai Transformasi Digital?</h2>
                <p>Bergabunglah dengan ribuan bisnis yang telah mempercayai AeruStore untuk mengelola operasional kasir mereka. Daftar sekarang dan rasakan perbedaannya!</p>
                <div class="cta-actions">
                    <a href="{{ route('register') }}" class="btn btn-white">
                        <i class="fas fa-user-plus"></i>
                        Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-accent">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>AeruStore</h3>
                    <p>Solusi kasir digital terdepan untuk bisnis modern. Mudah, cepat, dan terpercaya.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>Fitur</h3>
                    <a href="#">Kasir Digital</a>
                    <a href="#">Manajemen Produk</a>
                    <a href="#">Sistem Promo</a>
                    <a href="#">Laporan Penjualan</a>
                    <a href="#">Multi User</a>
                </div>

                <div class="footer-section">
                    <h3>Dukungan</h3>
                    <a href="#">Pusat Bantuan</a>
                    <a href="#">Dokumentasi</a>
                    <a href="#">Tutorial</a>
                    <a href="#">Kontak Support</a>
                </div>

                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-envelope"></i> support@aerustore.com</p>
                    <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} AeruStore. Semua hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Loading Screen
        window.addEventListener('load', function() {
            const loading = document.getElementById('loading');
            setTimeout(() => {
                loading.classList.add('fade-out');
                setTimeout(() => {
                    loading.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-cubic'
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navMenu = document.getElementById('navMenu');

        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Counter animation for stats
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + (element.textContent.includes('%') ? '%' : '+');
            }, 20);
        }

        // Trigger counter animation when stats section is visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumbers = entry.target.querySelectorAll('.stat-number');
                    statNumbers.forEach(stat => {
                        const target = parseInt(stat.textContent);
                        animateCounter(stat, target);
                    });
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Parallax effect for hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.hero');
            if (parallax) {
                const speed = scrolled * 0.5;
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });

        // Add loading states for buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.href && this.href.includes('#')) return;

                this.style.position = 'relative';
                this.style.pointerEvents = 'none';

                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

                setTimeout(() => {
                    this.innerHTML = originalContent;
                    this.style.pointerEvents = 'auto';
                }, 1000);
            });
        });

        console.log('AeruStore Landing Page loaded successfully! 🚀');
    </script>
</body>
</html>
