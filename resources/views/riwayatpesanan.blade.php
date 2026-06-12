
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan · LaunBass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- SHARED NAVBAR STYLES --}}
    @include('layouts.nav-styles')

    <style>
        html,
        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .screen {
            max-width: 520px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            padding: 18px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .filter-box {
            padding: 0 18px 14px;
        }

        .content {
            flex: 1;
            padding: 0 18px 120px;
        }

        .order-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 14px;
            margin-bottom: 12px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.10);
            display: flex;
            gap: 12px;
        }

        .order-main {
            flex: 1;
        }

        .order-title {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .order-phone {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px 12px;
            font-size: 12px;
        }

        .meta-item {
            background: #f9fafb;
            border-radius: 10px;
            padding: 6px 8px;
            display: flex;
            justify-content: space-between;
            font-weight: 600;
        }

        .order-actions {
            display: flex;
            align-items: flex-end;
        }

        .btn-restore {
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 12px;
            font-weight: 800;
            border: none;
            background: #f59e0b;
            color: #ffffff;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-restore:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            padding: 40px 0;
        }
    </style>
</head>

<body>
    <div class="screen">

        {{-- PAGE TITLE --}}
        <div class="page-header d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-light btn-sm" style="border-radius:12px;">
                <i class="bi bi-arrow-left"></i>
            </a>

            <span>Riwayat Pesanan</span>
        </div>


        {{-- FILTER TANGGAL (SERVER SIDE) --}}

        @if ($errors->any())
            <div class="alert alert-danger mx-3 mb-3">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif


        <form method="GET" action="{{ route('pesanan.riwayat') }}">
            <div class="row g-2 align-items-end mb-3">

                <div class="col">
                    <label class="form-label mb-1" style="font-size:12px;">
                        Dari Tanggal (Tanggal Selesai)
                    </label>
                    <input type="date" name="from" max="{{ date('Y-m-d') }}" class="form-control" value="{{ request('from') }}">
                </div>

                <div class="col">
                    <label class="form-label mb-1" style="font-size:12px;">
                        Sampai Tanggal (Tanggal Selesai)
                    </label>
                    <input type="date" name="to" max="{{ date('Y-m-d') }}" class="form-control" value="{{ request('to') }}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-primary">
                        Filter
                    </button>
                </div>

            </div>
        </form>



        {{-- LIST RIWAYAT --}}
        <div class="content">

            @forelse ($orders as $order)
                <div class="order-card">

                    <div class="order-main">
                        <div class="order-title">
                            {{ $order['nama'] }}
                        </div>
                        <div class="order-phone">
                            {{ $order['telepon'] }}
                        </div>

                        <div class="meta-grid">
                            <div class="meta-item">
                                <span>Berat</span>
                                <span>{{ $order['berat'] }} kg</span>
                            </div>
                            <div class="meta-item">
                                <span>Harga</span>
                                <span>Rp {{ $order['harga'] }}</span>
                            </div>
                            <div class="meta-item">
                                <span>Jumlah</span>
                                <span>{{ $order['jumlah'] }} pcs</span>
                            </div>
                            <div class="meta-item">
                                <span>Selesai</span>
                                <span>{{ $order['due'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- RESTORE --}}
                    <div class="order-actions">
                        <form method="POST" action="{{ route('pesanan.restore', $order['id']) }}"
                            onsubmit="return confirm('Restore pesanan ini ke status Diproses?')">
                            @csrf
                            @method('PATCH')
                            <button class="btn-restore">
                                Restore
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="empty-state">
                    Tidak ada riwayat pesanan
                </div>
            @endforelse

        </div>

        {{-- NAVBAR --}}
        @include('layouts.navbar')

    </div>
</body>

</html>
