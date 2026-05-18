<!-- NRP: 5026231186 | Nama: Javed Amani Syauki -->
<!-- NRP: 5026231206 | Nama: Rafael Dimas Khristianto -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Launbass App</title>
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

        :root{
            --primary: #0d9488;
            --secondary: #14b8a6;
            --accent: #0d9488;
            --bg: #5a9fb5;
            --muted: #6b7280;
            --card: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
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

        .container{max-width:480px;margin:0 auto;position:relative}

        .content{
            margin-top:48px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(30px);
            border-radius: 32px;
            padding: 40px 28px;
            padding-top: 60px;
            padding-bottom: 60px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.2), 0 0 1px rgba(255, 255, 255, 0.6) inset, 0 0 40px rgba(13, 148, 136, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.4);
            animation: fadeInUp 0.45s ease both;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 65px;
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

        .header h1{font-size:26px;color:var(--primary);font-weight:700;margin-bottom:8px}
        .header p{font-size:14px;color:var(--muted);line-height:1.6;margin-bottom:18px}

        .form-group{margin-bottom:20px}
        .form-group label{display:block;font-size:14px;font-weight:600;color:#111827;margin-bottom:8px}

        .form-group input{
            width:100%;padding:14px 16px;border-radius:12px;border:1px solid rgba(15,23,42,0.06);background:#fbfdff;font-size:15px;transition:all .18s ease;color:#0f172a
        }

        .form-group input::placeholder{color:rgba(15,23,42,0.35)}
        .form-group input:focus{outline:none;box-shadow:0 6px 18px rgba(79,70,229,0.08);border-color:rgba(79,70,229,0.35)}
        .form-group input.error{border-color:var(--accent)}

        .error-message{color:var(--error);font-size:13px;margin-top:8px}
        .success-message{background:linear-gradient(90deg,#ecfdf5,#e6fffa);color:var(--success);padding:12px;border-radius:10px;margin-bottom:14px;border-left:4px solid var(--success)}

        .btn-submit {
            width: 100%;
            padding: 13px 16px;
            border-radius: 18px;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 15px 35px rgba(13, 148, 136, 0.4), 0 0 30px rgba(13, 148, 136, 0.15);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.25);
            transition: left 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0a8070, #0d9488);
            box-shadow: 0 20px 50px rgba(13, 148, 136, 0.5), 0 0 40px rgba(13, 148, 136, 0.25);
            transform: translateY(-4px);
        }

        .btn-submit:active {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(13, 148, 136, 0.35), 0 0 20px rgba(13, 148, 136, 0.12);
        }

        @keyframes fadeInUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}

        @media(max-width:480px){.content{padding:28px 18px;margin-top:36px}}
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='{{ route('login') }}'">
            ←
        </button>
        <div class="content">
            <div class="header">
                <h1>Forgot password</h1>
                <p>Masukkan email Anda untuk proses verifikasi. Kami akan mengirimkan kode 4 digit ke email Anda.</p>
            </div>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.send-code') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="{{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="dzaki@gmail.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Send Code
                </button>
            </form>
        </div>
    </div>
</body>
</html>
