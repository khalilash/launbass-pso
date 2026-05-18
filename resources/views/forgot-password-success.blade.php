<!-- NRP: 5026231206 | Nama: Rafael Dimas Khristianto -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Berhasil - Launbass App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary:#0d9488;--secondary:#14b8a6;--bg:#f0f4ff;--muted:#6b7280;--success:#10b981
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Poppins',sans-serif;
            background: linear-gradient(135deg, #5a9fb5 0%, #36839b 25%, #2d7a8f 50%, #1a5f7a 75%, #0d4a65 100%);
            min-height:100vh;padding:20px;display:flex;align-items:center;justify-content:center;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(13, 148, 136, 0.1), rgba(20, 184, 166, 0.05));
            pointer-events: none;
            animation: gradientShift 15s ease infinite;
            z-index: -1;
        }
        @keyframes gradientShift {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .popup-overlay{position:fixed;inset:0;background:rgba(2,6,23,0.6);display:flex;align-items:center;justify-content:center;z-index:9999;animation:fadeIn .3s ease}
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
            color:#fff;font-weight:700;cursor:pointer;font-size:15px;transition: all 0.3s ease;
        }
        .popup-btn:hover{
            transform:translateY(-2px);
            box-shadow: 0 12px 32px rgba(13, 148, 136, 0.3)
        }

        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        @keyframes slideUp{from{opacity:0;transform:translateY(30px) scale(.98)}to{opacity:1;transform:none}}

        @media(max-width:480px){.popup-content{max-width:340px}.popup-header{padding:26px 18px}.popup-icon{width:70px;height:70px}.popup-icon svg{width:40px;height:40px}.popup-header h2{font-size:20px}.popup-body{padding:20px}}
    </style>
</head>
<body>
    <div class="popup-overlay">
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
</body>
</html>
