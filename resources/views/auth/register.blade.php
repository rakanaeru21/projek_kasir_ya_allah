{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\auth\register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kasir Yaallah</title>
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
    --card-bg: #234a65;
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
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

/* Background Pattern */
body::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(205, 79, 184, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

body::after {
    content: '';
    position: absolute;
    bottom: -50%;
    left: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(205, 79, 184, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite reverse;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* ========================================
   Register Container - Main Card
   ======================================== */
.register-container {
    background: var(--card-bg);
    padding: 48px 40px;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    width: 100%;
    max-width: 520px;
    animation: slideUp 0.4s ease-out;
    position: relative;
    z-index: 1;
    border: 1px solid rgba(205, 79, 184, 0.2);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ========================================
   Header - Title
   ======================================== */
.register-header {
    text-align: center;
    margin-bottom: 36px;
}

.register-header h2 {
    color: var(--color-text);
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -0.5px;
    margin-bottom: 8px;
}

.register-header h2 i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.register-header p {
    color: var(--color-text-muted);
    font-size: 14px;
}

/* ========================================
   Form Group - Input Container
   ======================================== */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: var(--color-text);
    font-weight: 500;
    font-size: 14px;
}

label i {
    color: var(--color-primary-light);
    margin-right: 6px;
    width: 16px;
}

/* ========================================
   Input Fields - Text, Email, Tel, Password
   ======================================== */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    font-size: 15px;
    color: var(--color-text);
    background-color: var(--color-bg);
    transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: var(--color-primary);
    background-color: var(--color-bg-alt);
    box-shadow: 0 0 0 4px rgba(205, 79, 184, 0.1);
}

input[type="text"]::placeholder,
input[type="email"]::placeholder,
input[type="tel"]::placeholder,
input[type="password"]::placeholder {
    color: var(--color-text-muted);
}

/* ========================================
   Register Button - Primary CTA
   ======================================== */
.btn-register {
    width: 100%;
    padding: 14px 20px;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(205, 79, 184, 0.4);
    margin-top: 8px;
}

.btn-register:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
}

.btn-register:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.btn-register:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(205, 79, 184, 0.2);
}

.btn-register i {
    margin-right: 8px;
}

/* ========================================
   Error Messages - Validation Feedback
   ======================================== */
.error {
    color: #ff5252;
    font-size: 12px;
    margin-top: 6px;
    font-weight: 500;
    display: block;
}

/* ========================================
   Alert Box - Error Notification
   ======================================== */
.alert {
    padding: 14px 16px;
    margin-bottom: 24px;
    border-radius: 8px;
    font-size: 14px;
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.alert-danger p {
    margin: 0;
    line-height: 1.5;
}

.alert-danger p:not(:last-child) {
    margin-bottom: 6px;
}

.alert-danger i {
    margin-right: 8px;
}

/* ========================================
   Login Link - Footer Link
   ======================================== */
.login-link {
    text-align: center;
    margin-top: 28px;
    color: var(--color-text-muted);
    font-size: 14px;
}

.login-link a {
    color: var(--color-primary-light);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.login-link a:hover {
    color: var(--color-primary);
    text-decoration: underline;
}

.login-link a:focus {
    outline: 2px solid var(--color-primary);
    outline-offset: 2px;
    border-radius: 4px;
}

/* ========================================
   Form Row - Two Column Layout
   ======================================== */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
@media (max-width: 480px) {
    body {
        padding: 16px;
    }

    .register-container {
        padding: 32px 24px;
    }

    .register-header h2 {
        font-size: 24px;
    }

    .register-header {
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"] {
        padding: 12px 14px;
        font-size: 14px;
    }

    .btn-register {
        padding: 12px 18px;
        font-size: 15px;
    }
}

@media (max-width: 360px) {
    .register-container {
        padding: 24px 20px;
    }

    .register-header h2 {
        font-size: 22px;
    }
}
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2><i class="fas fa-user-plus"></i> AeruStore</h2>
            <p>Daftar akun baru untuk mulai berbelanja</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama"><i class="fas fa-user"></i> Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                @error('nama')
                    <span class="error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nomor_telepon"><i class="fas fa-phone"></i> Nomor Telepon</label>
                    <input type="tel" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="08xxxxxxxxxx" required>
                    @error('nomor_telepon')
                        <span class="error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    @error('email')
                        <span class="error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                    @error('password')
                        <span class="error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>
