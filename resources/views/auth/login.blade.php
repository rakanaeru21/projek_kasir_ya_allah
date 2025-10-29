{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\auth\login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AeruStore</title>
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
   Login Container - Main Card
   ======================================== */
.login-container {
    background: var(--card-bg);
    padding: 48px 40px;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    width: 100%;
    max-width: 440px;
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
.login-header {
    text-align: center;
    margin-bottom: 36px;
}

.login-header h2 {
    color: var(--color-text);
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -0.5px;
    margin-bottom: 8px;
}

.login-header h2 i {
    color: var(--color-primary-light);
    margin-right: 8px;
}

.login-header p {
    color: var(--color-text-muted);
    font-size: 14px;
}

/* ========================================
   Form Group - Input Container
   ======================================== */
.form-group {
    margin-bottom: 24px;
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
   Input Fields - Email & Password
   ======================================== */
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid rgba(205, 79, 184, 0.2);
    border-radius: 8px;
    font-size: 15px;
    color: var(--color-text);
    background-color: var(--color-bg);
    transition: all 0.3s ease;
}

input[type="email"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: var(--color-primary);
    background-color: var(--color-bg-alt);
    box-shadow: 0 0 0 4px rgba(205, 79, 184, 0.1);
}

input[type="email"]::placeholder,
input[type="password"]::placeholder {
    color: var(--color-text-muted);
}

/* ========================================
   Remember Me - Checkbox Section
   ======================================== */
.remember-me {
    display: flex;
    align-items: center;
    margin-bottom: 24px;
}

.remember-me input[type="checkbox"] {
    margin-right: 10px;
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--color-primary);
}

.remember-me label {
    margin-bottom: 0;
    font-weight: normal;
    font-size: 14px;
    color: var(--color-text-muted);
    cursor: pointer;
}

/* ========================================
   Login Button - Primary CTA
   ======================================== */
.btn-login {
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
}

.btn-login:hover {
    background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(205, 79, 184, 0.6);
}

.btn-login:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(205, 79, 184, 0.4);
}

.btn-login:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(205, 79, 184, 0.2);
}

.btn-login i {
    margin-right: 8px;
}

/* ========================================
   Error Messages - Validation Feedback
   ======================================== */
.error {
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
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
   Register Link - Footer Link
   ======================================== */
.register-link {
    text-align: center;
    margin-top: 28px;
    color: var(--color-text-muted);
    font-size: 14px;
}

.register-link a {
    color: var(--color-primary-light);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.register-link a:hover {
    color: var(--color-primary);
    text-decoration: underline;
}

.register-link a:focus {
    outline: 2px solid var(--color-primary);
    outline-offset: 2px;
    border-radius: 4px;
}

/* ========================================
   Responsive Design - Mobile Optimization
   ======================================== */
@media (max-width: 480px) {
    body {
        padding: 16px;
    }

    .login-container {
        padding: 32px 24px;
    }

    .login-header h2 {
        font-size: 24px;
    }

    .login-header {
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"] {
        padding: 12px 14px;
        font-size: 14px;
    }

    .btn-login {
        padding: 12px 18px;
        font-size: 15px;
    }
}

@media (max-width: 360px) {
    .login-container {
        padding: 24px 20px;
    }

    .login-header h2 {
        font-size: 22px;
    }
}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-cash-register"></i>AeruStore</h2>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</body>
</html>
