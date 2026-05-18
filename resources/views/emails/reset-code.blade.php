<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #e0e0e0;
        }
        .header {
            background: rgba(28, 80, 98, 1);
            color: white;
            padding: 32px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .header p {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 32px 30px;
            color: #333;
        }
        .content p {
            line-height: 1.7;
            margin: 12px 0;
            font-size: 14px;
        }
        .code-box {
            background: rgba(28, 80, 98, 0.05);
            border: 2px solid rgba(28, 80, 98, 1);
            padding: 24px;
            margin: 24px 0;
            border-radius: 8px;
            text-align: center;
        }
        .code-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .code {
            font-size: 42px;
            font-weight: 700;
            letter-spacing: 12px;
            font-family: 'Courier New', monospace;
            color: rgba(28, 80, 98, 1);
        }
        .warning {
            background: #fff3cd;
            border-left: 3px solid #ffc107;
            padding: 14px 18px;
            margin: 20px 0;
            border-radius: 6px;
        }
        .warning p {
            margin: 0;
            font-size: 13px;
            color: #856404;
        }
        .footer {
            background: #f8f9fa;
            padding: 24px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Reset Password</h1>
            <p>Kode Verifikasi Anda</p>
        </div>
        
        <div class="content">
            <p>Halo <strong>{{ $nama }}</strong>,</p>
            
            <p>Anda menerima email ini karena kami menerima permintaan untuk mereset password akun Anda di <strong>Launbass App</strong>.</p>
            
            <div class="code-box">
                <div class="code-label">Kode Verifikasi Anda</div>
                <div class="code">{{ $code }}</div>
            </div>
            
            <p>Masukkan kode di atas pada halaman verifikasi untuk melanjutkan proses reset password.</p>
            
            <div class="warning">
                <p><strong>⚠️ Penting:</strong> Kode ini akan kadaluarsa dalam <strong>10 menit</strong>. Jangan bagikan kode ini kepada siapa pun!</p>
            </div>
            
            <p style="font-size: 13px; color: #666; margin-top: 24px;">
                Jika Anda tidak melakukan permintaan reset password, abaikan email ini. Tidak ada perubahan yang akan dilakukan pada akun Anda.
            </p>
        </div>
        
        <div class="footer">
            <p><strong>Launbass App</strong></p>
            <p>&copy; {{ date('Y') }} All rights reserved.</p>
            <p style="margin-top: 12px;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>