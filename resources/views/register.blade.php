<!-- NRP: 5026231227| Nama: Arjuna Veetaraq -->
<!-- NRP: 5026231206| Nama: Rafael Dimas Khristianto (membantu memperbaiki password requirements & UI/UX) -->

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar · LaunBass</title>

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

        :root {
            --brand-color: #0d9488;
            --brand-color-2: #14b8a6;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
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
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.15), transparent);
            border-radius: 50%;
            pointer-events: none;
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
            margin-bottom: 22px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .form-control {
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            padding: 12px 14px;
            padding-left: 34px;
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
        }

        .input-with-icon > i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
        }

        /* Show password toggle button */
        .pwd-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            padding: 4px;
            font-size: 16px;
            color: #9ca3af;
            cursor: pointer;
        }

        .pwd-toggle:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        .password-strength {
            height: 6px;
            background: #eef2ff;
            border-radius: 6px;
            margin-top: 12px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.28s ease;
            border-radius: 6px;
        }

        .strength-weak {
            width: 33%;
            background: #ef4444;
        }

        .strength-medium {
            width: 66%;
            background: #f59e0b;
        }

        .strength-strong {
            width: 100%;
            background: #10b981;
        }

        .password-requirements {
            padding: 16px 18px;
            margin-top: 14px;
            font-size: 14px;
            color: #6b7280;
            border: 1px solid rgba(13, 148, 136, 0.12);
            display: block;
            position: relative;
            border-radius: 12px;
        }

        .password-requirements strong {
            color: #0f172a;
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .password-requirements ul {
            list-style: none;
            margin: 0;
            padding: 0 0 0 6px;
            display: block;
        }

        .password-requirements li {
            margin: 8px 0;
            line-height: 1.45;
            padding-left: 22px;
            position: relative;
            color: #374151;
        }

        .password-requirements li.valid {
            color: #10b981;
        }

        .password-requirements li:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #d1d5db;
            box-shadow: 0 2px 6px rgba(13, 148, 136, 0.1);
        }

        .password-requirements li.valid:before {
            background: linear-gradient(135deg, var(--brand-color), var(--brand-color-2));
            box-shadow: 0 2px 6px rgba(13, 148, 136, 0.2);
        }

        .error-message {
            font-size: 12px;
            color: #dc2626;
            margin-top: 6px;
            display: block;
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
            color: #dc2626;
            margin-top: 6px;
        }

        .terms {
            font-size: 13px;
            color: var(--text-muted);
            margin: 12px 0;
        }

        .terms a {
            color: var(--brand-color);
            font-weight: 600;
            text-decoration: none;
        }

        .bottom-text {
            margin-top: 16px;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .bottom-text a {
            font-weight: 600;
            color: var(--brand-color);
            text-decoration: none;
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

        <h1 class="auth-title">Buat akun baru</h1>
        <p class="auth-subtitle">Akses fitur pengelolaan pesanan & pelanggan.</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 13px;">
                Periksa kembali data yang Anda masukkan.
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <div class="input-with-icon">
                    <i class="bi bi-person"></i>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Contoh: Budi Santoso"
                           value="{{ old('name') }}" required>
                </div>
                @error('name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-with-icon">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="contoh: owner@laundry.com"
                           value="{{ old('email') }}" required>
                </div>
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-with-icon">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Masukkan kata sandi baru" required>

                    <button type="button" class="pwd-toggle" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <span class="error-message" id="passwordError" style="display: none;"></span>
                <div class="password-requirements">
                    <strong>Password harus mengandung:</strong>
                    <ul>
                        <li id="req-length">Minimal 8 karakter</li>
                        <li id="req-case">Kombinasi huruf besar dan kecil</li>
                        <li id="req-number">Minimal 1 angka</li>
                    </ul>
                </div>
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            {{-- Confirm password --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <div class="input-with-icon">
                    <i class="bi bi-shield-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-control" placeholder="Ulangi kata sandi" required>
                </div>
                <span class="error-message" id="matchError" style="display: none;">
                    Password tidak cocok
                </span>
            </div>

            {{-- Terms --}}
            <p class="terms">
                Dengan mendaftar Anda menyetujui
                <a href="#">Syarat & Ketentuan</a> dan
                <a href="#">Kebijakan Privasi</a>.
            </p>

            {{-- Submit --}}
            <button type="submit" id="registerBtn" class="btn-primary-main" disabled>
                Daftar Sekarang
            </button>
        </form>

        {{-- Bottom --}}
        <p class="bottom-text">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </p>

    </div>
</div>

<script>
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('password');
    const pwdConfirm = document.getElementById('password_confirmation');
    const strengthBar = document.getElementById('strengthBar');
    const passwordError = document.getElementById('passwordError');
    const matchError = document.getElementById('matchError');
    const btn = document.getElementById('registerBtn');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');

    // password toggle
    toggle.addEventListener('click', () => {
        const type = pwd.type === 'password' ? 'text' : 'password';
        pwd.type = type;
        toggle.innerHTML = type === 'password'
            ? '<i class="bi bi-eye"></i>'
            : '<i class="bi bi-eye-slash"></i>';
    });

    function updateStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;

        strengthBar.className = 'password-strength-bar';
        if (strength === 1) {
            strengthBar.classList.add('strength-weak');
        } else if (strength === 2) {
            strengthBar.classList.add('strength-medium');
        } else if (strength === 3) {
            strengthBar.classList.add('strength-strong');
        }
    }

    function updateRequirements(password) {
        const reqLength = document.getElementById('req-length');
        const reqCase = document.getElementById('req-case');
        const reqNumber = document.getElementById('req-number');

        // Update length requirement
        if (password.length >= 8) {
            reqLength.classList.add('valid');
        } else {
            reqLength.classList.remove('valid');
        }

        // Update case requirement
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
            reqCase.classList.add('valid');
        } else {
            reqCase.classList.remove('valid');
        }

        // Update number requirement
        if (password.match(/[0-9]/)) {
            reqNumber.classList.add('valid');
        } else {
            reqNumber.classList.remove('valid');
        }
    }

    pwd.addEventListener('input', function() {
        const password = this.value;
        let errors = [];

        if (password.length < 8) {
            errors.push('Minimal 8 karakter');
        }

        if (!(password.match(/[a-z]/) && password.match(/[A-Z]/))) {
            if (password.length > 0) errors.push('Harus mengandung huruf besar dan kecil');
        }

        if (!password.match(/[0-9]/)) {
            if (password.length > 0) errors.push('Harus mengandung minimal 1 angka');
        }

        updateStrength(password);
        updateRequirements(password);

        if (errors.length > 0 && password.length > 0) {
            passwordError.textContent = errors[0];
            passwordError.style.display = 'block';
            pwd.classList.add('is-invalid');
        } else {
            passwordError.style.display = 'none';
            pwd.classList.remove('is-invalid');
        }

        checkFormValid();
    });

    pwdConfirm.addEventListener('input', function() {
        checkPasswordMatch();
        checkFormValid();
    });

    nameInput.addEventListener('input', checkFormValid);
    emailInput.addEventListener('input', checkFormValid);

    function checkPasswordMatch() {
        const password = pwd.value;
        const confirm = pwdConfirm.value;

        if (confirm && password !== confirm) {
            matchError.style.display = 'block';
            pwdConfirm.classList.add('is-invalid');
        } else {
            matchError.style.display = 'none';
            pwdConfirm.classList.remove('is-invalid');
        }
    }

    function checkFormValid() {
        const password = pwd.value;
        const confirm = pwdConfirm.value;
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();

        const hasMinLength = password.length >= 8;
        const hasCase = password.match(/[a-z]/) && password.match(/[A-Z]/);
        const hasNumber = password.match(/[0-9]/);
        const isMatch = password === confirm && password !== '';
        const allFilled = name !== '' && email !== '' && password !== '';

        btn.disabled = !(hasMinLength && hasCase && hasNumber && isMatch && allFilled);
    }

    // Initial check
    checkFormValid();
</script>

</body>
</html>
