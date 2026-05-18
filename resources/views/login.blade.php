{{-- NRP: 5026231206 | Nama: Rafael Dimas Khristianto --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Masuk · LaunBass</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(13, 148, 136, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(13, 148, 136, 0.5);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) scale(1);
            }
            50% {
                transform: translateY(-30px) scale(1.05);
            }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        :root {
            --brand-color: #0d9488;
            --brand-color-2: #14b8a6;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --error: #dc2626;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 24px 12px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -2;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.4);
            z-index: -1;
            pointer-events: none;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .auth-wrapper {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.8s ease-out;
            position: relative;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(30px);
            border-radius: 32px;
            padding: 28px 28px 26px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.2), 0 0 1px rgba(255, 255, 255, 0.6) inset, 0 0 40px rgba(13, 148, 136, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: visible;
        }

        .auth-card:hover {
            box-shadow: 0 40px 100px rgba(15, 23, 42, 0.25), 0 0 1px rgba(255, 255, 255, 0.6) inset, 0 0 60px rgba(13, 148, 136, 0.16);
            transform: translateY(-8px);
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.15), rgba(20, 184, 166, 0.1));
            font-size: 12px;
            font-weight: 600;
            color: #0d9488;
            margin-bottom: 12px;
            animation: slideInLeft 0.7s ease-out 0.08s both;
            border: 1.5px solid rgba(13, 148, 136, 0.3);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            letter-spacing: 0.3px;
        }

        .brand-badge:hover {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.22), rgba(20, 184, 166, 0.16));
            border-color: rgba(13, 148, 136, 0.6);
            transform: translateX(4px);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.15);
        }

        .brand-icon {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            color: #fff;
            font-size: 16px;
            box-shadow: 0 6px 20px rgba(13, 148, 136, 0.6);
            animation: float 3.5s cubic-bezier(0.42, 0, 0.58, 1) infinite;
            transition: all 0.3s ease;
        }

        .auth-title {
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 6px;
            animation: fadeInUp 0.8s ease-out 0.12s both;
            background: linear-gradient(135deg, #0d9488, #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease-out 0.18s both;
            line-height: 1.5;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
            animation: fadeInUp 0.8s ease-out both;
        }

        .form-control {
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            padding: 12px 14px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: fadeInUp 0.8s ease-out both;
            font-weight: 500;
        }

        .form-control::placeholder {
            color: #d1d5db;
            font-size: 13px;
            font-weight: 400;
        }

        .form-control:hover {
            border-color: #5eead4;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 15px rgba(13, 148, 136, 0.12);
        }

        .form-control:focus {
            border-color: var(--brand-color);
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.15), 0 0 0 1.5px var(--brand-color);
            outline: none;
        }

        .input-with-icon {
            position: relative;
            animation: fadeInUp 0.8s ease-out both;
        }

        .input-with-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input-with-icon input:focus ~ i {
            color: var(--brand-color);
        }

        .input-with-icon input {
            padding-left: 34px;
        }

        .helper-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-size: 12px;
            margin-bottom: 16px;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        .form-check-label {
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        .form-check-input:hover {
            border-color: var(--brand-color);
        }

        .forgot-text {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
            margin-bottom: 8px;
            animation: fadeInUp 0.8s ease-out 0.25s both;
        }

        .forgot-text a {
            color: var(--brand-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            display: inline-block;
            padding: 2px 6px;
        }

        .forgot-text a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2.5px;
            background: linear-gradient(90deg, #0d9488, #14b8a6);
            transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-radius: 2px;
        }

        .forgot-text a:hover {
            color: #14b8a6;
        }

        .forgot-text a:hover::after {
            width: 100%;
        }

        .btn-primary-main {
            background: linear-gradient(135deg, var(--brand-color), var(--brand-color-2));
            border: none;
            border-radius: 18px;
            padding: 13px 16px;
            font-size: 15px;
            font-weight: 700;
            width: 100%;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
            animation: fadeInUp 0.8s ease-out 0.32s both;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4), 0 0 30px rgba(13, 148, 136, 0.15);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .btn-primary-main::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.25);
            transition: left 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-primary-main:hover::before {
            left: 100%;
        }

        .btn-primary-main:hover {
            background: linear-gradient(135deg, #0a8070, #0d9488);
            box-shadow: 0 20px 50px rgba(13, 148, 136, 0.5), 0 0 40px rgba(13, 148, 136, 0.25);
            transform: translateY(-4px);
        }

        .btn-primary-main:active {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(13, 148, 136, 0.35), 0 0 20px rgba(13, 148, 136, 0.12);
        }

        .error-text {
            font-size: 12px;
            color: var(--error);
            margin-top: 4px;
            animation: fadeInUp 0.3s ease-out;
        }

        .bottom-text {
            margin-top: 16px;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .bottom-text a {
            font-weight: 700;
            color: var(--brand-color);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            display: inline-block;
            padding: 0;
            border-radius: 0;
        }

        .bottom-text a::before {
            content: '';
            position: absolute;
            inset: -2px -4px;
            background: transparent;
            border-radius: 0;
            z-index: -1;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .bottom-text a:hover {
            color: #14b8a6;
            transform: translateX(2px);
        }

        .bottom-text a:hover::before {
            background: transparent;
            box-shadow: none;
        }

        @media (max-width: 480px) {
            body {
                padding: 18px 12px;
            }
            .auth-card {
                padding: 22px 18px 20px;
                border-radius: 22px;
            }
        }

        .alert {
            border: none;
            border-radius: 16px;
            animation: fadeInUp 0.4s ease-out;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.08), rgba(239, 68, 68, 0.04));
            border-left: 3px solid var(--error);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.08);
            transition: all 0.3s ease;
        }

        .alert-danger {
            color: #7f1d1d;
            font-weight: 500;
        }

        .alert:hover {
            box-shadow: 0 8px 28px rgba(220, 38, 38, 0.12);
        }
    </style>
</head>

<body>
<div class="auth-wrapper">
    <div class="auth-card">

        <div class="brand-badge">
            <div class="brand-icon">
                <i class="bi bi-basket2-fill"></i>
            </div>
            <span>LaunBass · Laundry Assistant</span>
        </div>

        <h1 class="auth-title">Masuk ke akun kamu</h1>
        <p class="auth-subtitle">
            Kelola pesanan dan pelanggan dalam satu aplikasi.
        </p>

        {{-- ALERT UMUM --}}
        @if (session('error'))
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 13px;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-with-icon">
                    <i class="bi bi-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        placeholder="contoh: owner@laundry.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-2">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-with-icon">
                    <i class="bi bi-lock"></i>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Masukkan kata sandi"
                        required
                    >
                </div>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror

                {{-- Forgot password text (tambahan) --}}
                <p class="forgot-text">
                    Forgot your password?
                    <a href="/forgot-password">Reset your password</a>
                </p>
            </div>

            {{-- INGAT SAYA --}}
            <div class="helper-row">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>
            </div>

            {{-- TOMBOL LOGIN --}}
            <button type="submit" class="btn-primary-main">
                Masuk Sekarang
            </button>
        </form>

        <p class="bottom-text">
            Belum punya akun?
            <a href="{{ route('register') }}">Sign Up</a>
        </p>

    </div>
</div>
</body>
</html>
