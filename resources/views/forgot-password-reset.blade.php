<!-- NRP: 5026231186 | Nama: Javed Amani Syauki -->
<!-- NRP: 5026231206 | Nama: Rafael Dimas Khristianto -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Launbass App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary:#0d9488;--secondary:#14b8a6;--accent:#0d9488;--bg:#f0f4ff;--muted:#6b7280;--success:#10b981;--error:#ef4444
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Poppins',sans-serif;
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height:100vh;padding:20px;color:var(--muted);
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.4);
            pointer-events: none;
            z-index: -1;
        }

        .container{max-width:480px;margin:0 auto;position:relative}
        .content{
            margin-top:48px;padding:36px 26px;
            padding-top: 60px;
            padding-bottom: 60px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(30px);
            border-radius:16px;
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4);
            border:1px solid rgba(13, 148, 136, 0.15);
            animation:fadeInUp .45s ease both;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 36px;
            height: 36px;
            border-radius: 12px;
            border: none;
            background: transparent;
            color: var(--primary);
            font-weight: 600;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 20;
        }

        .back-button:hover {
            background: rgba(13, 148, 136, 0.1);
            transform: translateY(-2px);
        }

        .header h1{font-size:24px;color:var(--primary);font-weight:700;margin-bottom:8px}
        .header p{font-size:14px;color:var(--muted);margin-bottom:14px}

        .form-group{margin-bottom:18px}
        .form-group label{display:block;font-size:14px;font-weight:600;color:#0f172a;margin-bottom:8px}
        .input-wrapper{position:relative}

        .form-group input{width:100%;padding:14px 16px;border-radius:12px;border:1px solid rgba(15,23,42,0.06);background:#fbfdff;font-size:15px;color:#0f172a;transition:box-shadow .15s ease}
        .form-group input:focus{
            outline:none;
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.15);
            border-color: rgba(13, 148, 136, 0.4)
        }
        .form-group input.error{border-color:var(--error)}

        .password-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:18px;color:var(--muted)}
        .password-toggle:hover{color:var(--primary)}

        .error-message{color:var(--error);font-size:13px;margin-top:8px}

        .password-requirements{
            background: linear-gradient(180deg, rgba(13, 148, 136, 0.05), rgba(20, 184, 166, 0.02));
            border-radius:14px;
            padding:16px 18px;
            margin-top:14px;
            font-size:14px;
            color:var(--muted);
            border: 1px solid rgba(13, 148, 136, 0.12);
            display: block;
            position: relative;
        }

        .password-requirements strong{
            color:#0f172a;
            display:block;
            margin-bottom:10px;
            font-size:15px;
        }

        .password-requirements ul{
            list-style:none;
            margin:0;
            padding:0 0 0 6px;
            display:block;
        }

        .password-requirements li{
            margin:8px 0;
            line-height:1.45;
            padding-left:22px;
            position:relative;
            color:#374151;
        }

        .password-requirements li:before{
            content:'';
            position:absolute;
            left:0;
            top:50%;
            transform:translateY(-50%);
            width:10px;
            height:10px;
            border-radius:50%;
            background: linear-gradient(135deg,var(--primary),var(--secondary));
            box-shadow: 0 2px 6px rgba(13, 148, 136, 0.2);
        }

        .password-strength{height:6px;background:#eef2ff;border-radius:6px;margin-top:12px;overflow:hidden}
        .password-strength-bar{height:100%;width:0;transition:width .28s ease;border-radius:6px}
        .strength-weak{width:33%;background:#ef4444}
        .strength-medium{width:66%;background:#f59e0b}
        .strength-strong{width:100%;background:var(--success)}

        .btn-submit{
            width:100%;padding:13px 16px;border-radius:18px;border:none;
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            color:#fff;font-weight:700;
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4);
            cursor:pointer;margin-top:16px;transition: all 0.3s ease;position: relative;
            overflow: hidden;
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #0b6b63, #129589);
            box-shadow: 0 20px 45px rgba(13, 148, 136, 0.5);
            transform: translateY(-4px);
        }
        .btn-submit:hover::before {
            left: 100%;
        }
        .btn-submit:disabled{opacity:.6;cursor:not-allowed}

        /* Success Popup */
        .popup-overlay{display:none;position:fixed;inset:0;background:rgba(2,6,23,0.6);z-index:9999}
        .popup-overlay.show{display:flex;align-items:center;justify-content:center}
        .popup-content{background:#fff;border-radius:20px;max-width:380px;width:90%;overflow:hidden;animation:slideUp .38s ease;box-shadow:0 20px 60px rgba(2,6,23,0.2)}

        .popup-header{
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            padding:34px 28px;text-align:center
        }
        .popup-icon{
            width:80px;height:80px;background:#fff;border-radius:50%;margin:0 auto 16px;
            display:flex;align-items:center;justify-content:center;
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.2)
        }
        .popup-icon svg{width:44px;height:44px}
        .popup-header h2{color:#fff;font-size:22px;font-weight:700;margin:0}

        .popup-body{padding:26px;text-align:center}
        .popup-body p{color:var(--muted);font-size:15px;margin-bottom:18px}
        .popup-btn{
            width:100%;padding:12px;border-radius:14px;border:none;
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            color:#fff;font-weight:700;cursor:pointer;transition: all 0.3s ease;
        }
        .popup-btn:hover{
            transform:translateY(-2px);
            box-shadow: 0 12px 32px rgba(13, 148, 136, 0.3)
        }

        @keyframes fadeInUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:none}}
        @keyframes slideUp{from{opacity:0;transform:translateY(30px) scale(.98)}to{opacity:1;transform:none}}

        @media(max-width:480px){.content{padding:26px 18px;margin-top:36px}.popup-content{max-width:340px}.popup-header{padding:26px 18px}.popup-icon{width:70px;height:70px}.popup-icon svg{width:40px;height:40px}.popup-header h2{font-size:20px}.popup-body{padding:20px}}
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.history.back()">
            ←
        </button>
        <div class="content">
            <div class="header">
                <h1>Reset Password</h1>
                <p>Password baru harus berbeda dengan password yang pernah digunakan sebelumnya.</p>
            </div>

            <!-- Note: action points to route name 'password.update' sesuai web.php kamu -->
            <form method="POST" action="{{ route('password.update') }}" id="resetForm">
                @csrf
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password baru"
                            required
                            autocomplete="new-password"
                        >
                        <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <span class="error-message" id="passwordError" style="display: none;"></span>
                    <div class="password-requirements">
                        <strong>Password harus mengandung:</strong>
                        <ul>
                            <li>Minimal 8 karakter</li>
                            <li>Kombinasi huruf besar dan kecil</li>
                            <li>Minimal 1 angka</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ketik ulang password baru"
                            required
                            autocomplete="new-password"
                        >
                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">👁️</span>
                    </div>
                    <span class="error-message" id="matchError" style="display: none;">
                        Password tidak cocok
                    </span>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn" disabled>
                    Reset Password
                </button>
            </form>
        </div>
    </div>

    <!-- Success Popup -->
    <div class="popup-overlay" id="successPopup">
        <div class="popup-content">
            <div class="popup-header">
                <div class="popup-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="rgba(79, 70, 229, 1)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h2>Password Changed!</h2>
            </div>
            <div class="popup-body">
                <p>Password Anda telah berhasil diubah. Silakan login dengan password baru Anda.</p>
                <a href="{{ route('login') }}" class="popup-btn" role="button">
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    {{-- Show popup jika password_changed flag ada --}}
    @if(session('password_changed'))
        <script>
            console.log('✅ Password changed flag detected!');
            document.addEventListener('DOMContentLoaded', function() {
                console.log('✅ DOM fully loaded');
                const successPopup = document.getElementById('successPopup');
                console.log('✅ Popup element found:', successPopup);
                if (successPopup) {
                    console.log('✅ Adding show class to popup');
                    successPopup.classList.add('show');
                }
            });
        </script>
    @else
        <script>
            console.log('❌ NO password_changed flag detected');
        </script>
    @endif

    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const strengthBar = document.getElementById('strengthBar');
        const matchError = document.getElementById('matchError');
        const passwordError = document.getElementById('passwordError');
        const submitBtn = document.getElementById('submitBtn');
        const resetForm = document.getElementById('resetForm');
        const successPopup = document.getElementById('successPopup');

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling;
            if (field.type === 'password') {
                field.type = 'text';
                toggle.textContent = '👁️‍🗨️';
            } else {
                field.type = 'password';
                toggle.textContent = '👁️';
            }
        }

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

        passwordInput.addEventListener('input', function() {
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

            if (errors.length > 0 && password.length > 0) {
                passwordError.textContent = errors[0];
                passwordError.style.display = 'block';
                passwordInput.classList.add('error');
            } else {
                passwordError.style.display = 'none';
                passwordInput.classList.remove('error');
            }

            checkPasswordMatch();
        });

        confirmInput.addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            const hasMinLength = password.length >= 8;
            const hasUpperLower = password.match(/[a-z]/) && password.match(/[A-Z]/);
            const hasNumber = password.match(/[0-9]/);

            if (confirm && password !== confirm) {
                matchError.style.display = 'block';
                confirmInput.classList.add('error');
                submitBtn.disabled = true;
            } else {
                matchError.style.display = 'none';
                confirmInput.classList.remove('error');

                // Enable button only if password meets all requirements
                submitBtn.disabled = !(hasMinLength && hasUpperLower && hasNumber && password === confirm);
            }
        }

        // Handle form submission: only prevent default if invalid.
        resetForm.addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirm = confirmInput.value;

            const hasMinLength = password.length >= 8;
            const hasUpperLower = password.match(/[a-z]/) && password.match(/[A-Z]/);
            const hasNumber = password.match(/[0-9]/);

            if (!(hasMinLength && hasUpperLower && hasNumber && password === confirm)) {
                // Kalau invalid, prevent submit dan show client-side feedback
                e.preventDefault();
                checkPasswordMatch();
                if (!hasMinLength) {
                    passwordError.textContent = 'Password minimal 8 karakter';
                    passwordError.style.display = 'block';
                }
            }
            // jika valid, biarkan form submit normal — controller akan redirect ke route('password.reset')
            // dan flash session 'password_changed' akan memicu popup pada load berikutnya.
        });

    </script>
</body>
</html>
