{{-- filepath: c:\xampp\htdocs\(yaallah_projek_kasir)\resources\views\auth\register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kasir Yaallah</title>
    <style>
        /* ========================================
   CSS Variables - Custom Properties
   ======================================== */
:root {
    --color-primary: #cd4fb8;
    --color-primary-light: #cd4fb8;
    --color-primary-dark: #cd4fb8;
    --color-secondary: #FFE900;
    --color-secondary-light: #FFF654;
    --color-bg: #1B3C53;
    --color-bg-alt: #1B3C53;
    --color-text: #F5F5F5;
    --color-text-muted: #f5f5f5;
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
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* ========================================
   Register Container - Main Card
   ======================================== */
.register-container {
    background: var(--color-bg);
    padding: 48px 40px;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 480px;
    animation: slideUp 0.4s ease-out;
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
h2 {
    text-align: center;
    color: var(--color-text);
    margin-bottom: 36px;
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -0.5px;
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

/* ========================================
   Input Fields - Text, Email, Tel, Password
   ======================================== */
input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #E5E7EB;
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
    box-shadow: 0 0 0 4px rgba(7, 203, 115, 0.1);
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
    background: var(--color-primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(255, 0, 123, 0.3);
}

.btn-register:hover {
    background: var(--color-primary-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 0, 123, 0.4);
}

.btn-register:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(255, 0, 123, 0.3);
}

.btn-register:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(255, 0, 123, 0.2);
}

/* ========================================
   Error Messages - Validation Feedback
   ======================================== */
.error {
    color: #DC2626;
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
    background: #FEE2E2;
    color: #991B1B;
    border: 1px solid #FCA5A5;
}

.alert-danger p {
    margin: 0;
    line-height: 1.5;
}

.alert-danger p:not(:last-child) {
    margin-bottom: 6px;
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
    color: var(--color-primary);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.login-link a:hover {
    color: var(--color-primary-dark);
    text-decoration: underline;
}

.login-link a:focus {
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

    .register-container {
        padding: 32px 24px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 20px;
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

    h2 {
        font-size: 22px;
    }
}
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun Baru</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                @error('nama')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="08xxxxxxxxxx" required>
                @error('nomor_telepon')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn-register">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>
