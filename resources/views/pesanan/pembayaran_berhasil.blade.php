{{-- NRP: 5026231021| Nama: Zaskia Muazatun M --}}

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran Berhasil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #0d9488;
    --secondary: #14b8a6;
    --success: #10b981;
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
    align-items: center;
    min-height: 100vh;
}

.card-container {
    width: 420px;
    background: #fff;
    border-radius: 20px;
    padding: 30px 24px;
    box-shadow: 0 4px 16px rgba(13, 148, 136, 0.12);
    border: 1px solid rgba(13, 148, 136, 0.1);
    text-align: center;
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.success-icon {
    font-size: 80px;
    color: var(--success);
    margin-bottom: 20px;
}

.title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 10px;
}

.subtitle {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-main);
    margin-bottom: 25px;
}

.row-between {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    margin-bottom: 12px;
}

.detail-label {
    color: var(--text-main);
}

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
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: #fff;
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
    margin-bottom: 12px;
}

.pay-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
    color: #fff;
}

.pay-btn:active {
    transform: scale(0.97);
}
</style>
</head>

<body>
<div class="card-container">

    <div class="success-icon">
        <i class="bi bi-check-circle-fill"></i>
    </div>

    <div class="title">Selamat!</div>
    <div class="subtitle">Pembayaran berhasil untuk pesanan ORD{{ $pesanan->IDPesanan }}.</div>

    <div class="row-between">
        <span>ID Pesanan:</span>
        <span>ORD{{ $pesanan->IDPesanan }}</span>
    </div>

    <div class="row-between">
        <span>Tanggal:</span>
        <span>{{ date('d/m/Y') }}</span>
    </div>

    <div class="row-between">
        <span>Jumlah:</span>
        <span>Rp {{ number_format($pesanan->Total_Biaya ?? 0,0,',','.') }}</span>
    </div>

    <button class="pay-btn" onclick="window.location='{{ route('pesanan.detail', $pesanan->IDPesanan) }}'">
        Kembali ke Detail Pesanan
    </button>

    <button class="pay-btn" onclick="window.location='{{ route('tambahpesanan') }}'">
        Tambah Pesanan Baru
    </button>

</div>
</body>
</html>
