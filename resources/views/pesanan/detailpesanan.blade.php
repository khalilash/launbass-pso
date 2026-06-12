
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d9488;
            --secondary: #14b8a6;
            --accent: #14b8a6;
            --success: #10b981;
            --error: #ef4444;
            --bg-main: #f5f5f5;
            --text-main: #111827;
            --text-muted: #6b7280;
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

        .card-container {
            width: 420px;
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(13, 148, 136, 0.12);
            border: 1px solid rgba(13, 148, 136, 0.1);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-box {
            background: #f9fafb;
            border: 2px solid rgba(13, 148, 136, 0.1);
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            color: var(--text-main);
        }

        .detail-box p {
            margin-bottom: 12px;
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-main);
        }

        .row-between {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            margin-bottom: 15px;
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
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
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

        <div class="title">
            <i class="bi bi-card-text"></i> Detail Pesanan
        </div>

        <div class="detail-box">

            <div class="row-between">
                <span>ORD{{ $pesanan->IDPesanan }}</span>
                <span>{{ date('d/m/Y') }}</span>
            </div>

            <p><span class="detail-label">Nama:</span> {{ $pesanan->nama_pelanggan }}</p>
            <p><span class="detail-label">No Telp:</span> {{ $pesanan->no_telp ?? '-' }}</p>
            <p><span class="detail-label">Alamat:</span> {{ $pesanan->alamat ?? '-' }}</p>

            {{-- KATEGORI PRODUK DIHAPUS SESUAI PERMINTAAN --}}

            <p><span class="detail-label">Jumlah:</span> {{ $pesanan->Jumlah_Pcs }}</p>
            <p><span class="detail-label">Berat:</span> {{ $pesanan->Berat_Kg }} kg</p>

            <p>
                <span class="detail-label">Paket:</span>
                {{ $pesanan->nama_paket }}
            </p>

            <p>
                <span class="detail-label">Harga / Kg:</span>
                Rp {{ number_format($pesanan->HargaPerKg, 0, ',', '.') }}
            </p>

            <p>
                <span class="detail-label">Total:</span>
                Rp {{ number_format($pesanan->Total_Biaya, 0, ',', '.') }}
            </p>


            <p><span class="detail-label">Kasir:</span> {{ $pesanan->nama_user ?? '-' }}</p>

            <p><span class="detail-label">Catatan:</span><br>
                {{ $pesanan->Catatan ?? '-' }}
            </p>

        </div>

        <button class="pay-btn" onclick="window.location='{{ route('pembayaran.cash.form', $pesanan->IDPesanan) }}'">
            Bayar Cash
        </button>

        <button class="pay-btn" onclick="window.location='{{ route('pembayaran.qris.form', $pesanan->IDPesanan) }}'">
            Bayar QRIS
        </button>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
