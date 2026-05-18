<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            text-align: center;
            padding: 30px;
        }
        .container {
            max-width: 420px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 25px;
        }
        .button {
            display: block;
            background: #ffffff;
            border: 2px solid #0d9488;
            border-radius: 12px;
            padding: 18px;
            margin: 15px 0;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }
        .button:hover {
            background: #0d9488;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Pilih Metode Pembayaran</h2>

    <a href="{{ route('pembayaran.print', $pesanan->IDPesanan) }}?via=cash" class="button">
        💵 Pembayaran Cash
    </a>

    <a href="{{ route('pembayaran.print', $pesanan->IDPesanan) }}?via=qris" class="button">
        📌 Pembayaran QRIS
    </a>
</div>

</body>
</html>
