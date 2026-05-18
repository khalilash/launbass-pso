<!-- NRP: 5026231186 | Nama: Javed Amani Syauki -->
<!-- NRP: 5026231206 | Nama: Rafael Dimas Khristianto -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - Launbass App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary:#0d9488;--secondary:#14b8a6;--accent:#0d9488;--bg:#f0f4ff;--muted:#6b7280
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
            margin-top:50px;padding:34px 26px;
            padding-top: 60px;
            padding-bottom: 60px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(30px);
            border-radius:16px;
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4);
            border:1px solid rgba(13, 148, 136, 0.15);
            animation:fadeInUp .4s ease both;
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

        .header h1{font-size:24px;color:var(--primary);font-weight:700;margin-bottom:6px}
        .header p{font-size:14px;color:var(--muted);margin-bottom:10px}
        .email-display{color:#0f172a;font-weight:600;margin-bottom:18px}

        .code-input-container{display:flex;justify-content:space-between;gap:12px;margin-bottom:22px}
        .code-input{width:72px;height:72px;border-radius:12px;border:1px solid rgba(15,23,42,0.06);background:#fbfdff;font-size:32px;font-weight:700;text-align:center;color:#0f172a;transition:all .15s ease}
        .code-input:focus{
            outline:none;
            box-shadow: 0 8px 24px rgba(13, 148, 136, 0.15);
            border-color: rgba(13, 148, 136, 0.5);
            background:#fff
        }
        .code-input.error{border-color:#ef4444}

        .resend-section{ text-align:center;margin-bottom:18px;color:var(--muted)}
        .resend-section a{
            color:var(--primary);font-weight:600;text-decoration:none;margin-left:6px;
            transition: all 0.2s ease;
        }
        .resend-section a:hover {
            color: #0b6b63;
        }

        .btn-submit{
            width:100%;padding:13px 16px;border-radius:18px;border:none;
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            color:#fff;font-weight:700;
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4);
            cursor:pointer;transition: all 0.3s ease;position: relative;
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

        .error-message{color:#ef4444;font-size:13px;text-align:center;margin-top:12px}

        .dev-info{background:linear-gradient(90deg,#fff7ed,#fff3e0);border-radius:12px;padding:12px;border:1px solid rgba(255,193,7,0.12);margin-bottom:14px}

        @keyframes fadeInUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

        @media(max-width:480px){.code-input{width:60px;height:60px;font-size:28px}.content{padding:26px 16px}}
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='{{ route('password.request') }}'">
            ←
        </button>
        <div class="content">
            <div class="header">
                <h1>Enter 4 Digit Code</h1>
                <p>Enter 4 digit code that your receive on</p>
                <div class="email-display">your email (<strong>{{ session('reset_email') }}</strong>).</div>
            </div>

            @if (session('reset_code_for_testing'))
                <div class="dev-info">
                    <strong>🔧 Development Mode:</strong><br>
                    Kode: <strong style="font-size: 16px; color: #856404;">{{ session('reset_code_for_testing') }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('password.verify-code') }}" id="verifyForm">
                @csrf

                <div class="code-input-container">
                    <input type="text" maxlength="1" class="code-input" id="code1" autocomplete="off" inputmode="numeric">
                    <input type="text" maxlength="1" class="code-input" id="code2" autocomplete="off" inputmode="numeric">
                    <input type="text" maxlength="1" class="code-input" id="code3" autocomplete="off" inputmode="numeric">
                    <input type="text" maxlength="1" class="code-input" id="code4" autocomplete="off" inputmode="numeric">
                </div>

                <input type="hidden" name="code" id="codeHidden" class="hidden-input">

                @error('code')
                    <span class="error-message">{{ $message }}</span>
                @enderror

                <div class="resend-section">
                    <span>Email not received?</span>
                    <a href="{{ route('password.request') }}">Resend code</a>
                </div>

                <button type="submit" class="btn-submit">
                    Continue
                </button>
            </form>
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll('.code-input');
        const form = document.getElementById('verifyForm');
        const hiddenInput = document.getElementById('codeHidden');

        // Auto-focus first input
        inputs[0].focus();

        inputs.forEach((input, index) => {
            // Handle input
            input.addEventListener('input', (e) => {
                const value = e.target.value;

                // Only allow numbers
                if (!/^\d$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                // Move to next input
                if (value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                // Update hidden input
                updateHiddenInput();
            });

            // Handle backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            // Handle paste
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text');
                const digits = pastedData.replace(/\D/g, '').split('');

                digits.forEach((digit, i) => {
                    if (index + i < inputs.length) {
                        inputs[index + i].value = digit;
                    }
                });

                // Focus last filled input
                const lastIndex = Math.min(index + digits.length, inputs.length - 1);
                inputs[lastIndex].focus();

                updateHiddenInput();
            });
        });

        function updateHiddenInput() {
            const code = Array.from(inputs).map(input => input.value).join('');
            hiddenInput.value = code;
        }

        // Auto-submit when all 4 digits are entered
        inputs[3].addEventListener('input', () => {
            const code = Array.from(inputs).map(input => input.value).join('');
            if (code.length === 4) {
                setTimeout(() => form.submit(), 500);
            }
        });
    </script>
</body>
</html>
