{{-- NRP: 5026231021| Nama: Zaskia Muazatun M --}}

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bayar QRIS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root {
    --primary: #0d9488;
    --secondary: #14b8a6;
    --bg-main: #f5f5f5;
    --text-main: #111827;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background: var(--bg-main);
    display: flex;
    justify-content: center;
    padding: 60px 0;
}

.mobile-container {
    width: 430px;
    max-width: 100%;
    padding: 0 12px;
}

.card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid rgba(13,148,136,0.1);
    padding: 24px;
    text-align: center;
    box-shadow: 0 4px 16px rgba(13,148,136,0.12);
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h3 {
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 16px;
    font-size: 1.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

p.total {
    font-size: 1rem;
    color: var(--text-main);
    font-weight: 600;
    margin-bottom: 20px;
}

img.qr-code {
    border-radius: 12px;
    margin-bottom: 20px;
    width: 220px;
    height: 220px;
}

/* Tombol gradien hijau mirip Detail Pesanan */
.pay-btn {
    width: 100%;
    padding: 0.85rem 1.8rem;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
    margin-top: 12px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    box-shadow: 0 4px 12px rgba(13,148,136,0.3);
}

.pay-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(13,148,136,0.4);
    color: #fff;
}

.pay-btn:active {
    transform: scale(0.97);
}
</style>
</head>

<body>
<div class="mobile-container">
    <div class="card">

        <h3><i class="bi bi-qr-code-scan"></i> Bayar (QRIS) — Pesanan #{{ $pesanan->IDPesanan }}</h3>

        <p class="total">Total: <b>Rp {{ number_format($pesanan->Total_Biaya ?? 0,0,',','.') }}</b></p>

        <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=QRIS-DUMMY-{{ $pesanan->IDPesanan }}" alt="QRIS" class="qr-code">

        <form action="{{ route('pembayaran.qris.process', $pesanan->IDPesanan) }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $pesanan->Total_Biaya ?? 0 }}">
            <button class="pay-btn"><i class="bi bi-check2-circle"></i> Catat Pembayaran</button>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
