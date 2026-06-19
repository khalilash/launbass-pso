
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Homepage · LaunBass</title>
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
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, sans-serif !important;
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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(13, 148, 136, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(13, 148, 136, 0.5);
            }
        }

        :root {
            --bg-main: #eef2ff;
            --card-bg: #ffffff;
            --primary: #0d9488;
            --primary-soft: #eef2ff;
            --accent: #14b8a6;
            --pill-bg: #f5f7fb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --fab-blue: #0d9488;
            --success: #10b981;
            --error: #ef4444;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f5f5;
            color: var(--text-main);
            position: relative;
        }

        .screen {
            max-width: 520px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* subtle top gradient mask */
        .screen:before {
            content: "";
            position: absolute;
            inset: 0 0 auto 0;
            height: 120px;
            background: linear-gradient(180deg, rgba(13, 148, 136, 0.15), transparent);
            pointer-events: none;
        }

        /* === TOP BAR === */
        .top-bar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: saturate(160%) blur(15px);
            padding: 14px 18px 10px;
            display: flex;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(13, 148, 136, 0.08);
            animation: fadeInUp 0.6s ease-out;
            box-shadow: 0 8px 30px rgba(13, 148, 136, 0.06);
            transition: all 0.3s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            letter-spacing: .3px;
            font-size: 14px;
            color: #111827;
            white-space: nowrap;
        }

        .brand-badge {
            width: 32px;
            height: 32px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.4) inset;
            animation: float 3.5s cubic-bezier(0.42, 0, 0.58, 1) infinite;
            transition: all 0.3s ease;
        }

        .brand-badge:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 28px rgba(13, 148, 136, 0.4);
        }

        .search-wrapper {
            flex: 1;
            animation: slideInLeft 0.6s ease-out 0.1s both;
        }

        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
            transition: all .3s ease;
            opacity: .9;
        }

        .search-input {
            width: 100%;
            border-radius: 14px;
            padding: 11px 12px 11px 38px;
            border: 1.5px solid rgba(13, 148, 136, .12);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
            font-size: 13px;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            font-weight: 500;
        }

        .search-input::placeholder {
            color: #cbd5e1;
        }

        .search-input:hover {
            border-color: rgba(13, 148, 136, .25);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.10);
        }

        .search-input:focus {
            outline: none;
            border-color: rgba(13, 148, 136, .7);
            box-shadow: 0 0 0 4px rgba(13, 148, 136, .12), 0 0 0 1.5px rgba(13, 148, 136, .6);
        }

        .search-input:focus+.search-icon {
            color: var(--fab-blue);
        }

        .menu-btn {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            border: none;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.10);
            animation: slideInRight 0.6s ease-out 0.2s both;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        .menu-btn:hover {
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.15);
            transform: translateY(-3px);
        }

        .menu-btn:active {
            transform: translateY(-1px);
        }

        .menu-btn i {
            font-size: 18px;
        }

        .menu-dropdown {
            position: absolute;
            right: 18px;
            top: 60px;
            width: 220px;
            background-color: #ffffff;
            border-radius: 18px;
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.2), 0 0 1px rgba(13, 148, 136, 0.25) inset;
            overflow: hidden;
            display: none;
            z-index: 20;
            border: 1px solid rgba(13, 148, 136, 0.15);
            animation: fadeInUp .3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .menu-item {
            padding: 13px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .menu-item i {
            color: var(--primary);
            font-size: 16px;
        }

        .menu-item+.menu-item {
            border-top: 1px solid #f3f4f6;
        }

        .menu-item:hover {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.1), rgba(15, 60, 77, 0.08));
            padding-left: 22px;
            color: var(--primary);
        }

        /* === TABS === */
        .tab-wrapper {
            padding: 10px 18px 12px;
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .tab-pill {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 6px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.10);
            border: 1.5px solid rgba(13, 148, 136, 0.10);
        }

        .tab-btn {
            border-radius: 12px;
            border: none;
            padding: 11px 12px;
            font-size: 13px;
            font-weight: 700;
            background-color: transparent;
            color: var(--text-muted);
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(13, 148, 136, .08);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(15, 60, 77, 0.25);
        }

        /* === ORDER LIST === */
        .content {
            flex: 1;
            padding: 0 18px 100px;
            overflow-y: auto;
        }

        .empty-state {
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
            padding: 40px 0;
        }

        .order-card {
            background-color: var(--card-bg);
            border-radius: 18px;
            padding: 14px;
            margin-bottom: 12px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.10);
            display: flex;
            gap: 12px;
            animation: fadeInUp .45s ease-out backwards;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid rgba(0, 196, 214, 0.10);
        }

        .order-card:hover {
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.16);
            transform: translateY(-4px);
            border-color: rgba(0, 196, 214, 0.25);
        }

        .order-card:nth-child(1) {
            animation-delay: .05s
        }

        .order-card:nth-child(2) {
            animation-delay: .1s
        }

        .order-card:nth-child(3) {
            animation-delay: .15s
        }

        .order-card:nth-child(4) {
            animation-delay: .2s
        }

        .order-card:nth-child(5) {
            animation-delay: .25s
        }

        .order-card:nth-child(6) {
            animation-delay: .3s
        }

        .order-card:nth-child(7) {
            animation-delay: .35s
        }

        .order-card:nth-child(8) {
            animation-delay: .4s
        }

        .order-card:nth-child(9) {
            animation-delay: .45s
        }

        .order-card:nth-child(10) {
            animation-delay: .5s
        }

        .order-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #e0f2fe, #f0fdfa);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d9488;
            font-weight: 800;
            box-shadow: 0 6px 16px rgba(13, 148, 136, .12), inset 0 0 0 1px rgba(0, 0, 0, .04);
            font-size: 16px;
        }

        .order-main {
            flex: 1;
        }

        .order-title {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 3px;
            letter-spacing: .05px;
        }

        .order-title span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .order-phone {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 500;
        }

        .meta-grid {
            font-size: 12px;
            color: var(--text-muted);
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px 16px;
            margin-top: 4px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            background: #fff;
            border: 1px solid #eef2ff;
            border-radius: 10px;
            padding: 6px 8px;
            box-shadow: inset 0 0 0 1px rgba(79, 70, 229, .03);
        }

        .meta-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .meta-value {
            color: #111827;
            font-weight: 700;
        }

        .order-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            min-width: 150px;
            gap: 4px;
        }

        .order-actions-top {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            border: 1.5px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
        }

        .icon-btn:hover {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 8px 20px rgba(15, 60, 77, 0.25);
            transform: translateY(-2px);
        }

        .badge-service {
            border-radius: 999px;
            padding: 4px 10px;
            background: linear-gradient(135deg, rgba(0, 196, 214, 0.1), rgba(15, 60, 77, 0.05));
            border: 1px solid rgba(0, 196, 214, 0.2);
            font-size: 11px;
            color: var(--primary);
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-status {
            border-radius: 999px;
            padding: 9px 15px;
            font-size: 12px;
            font-weight: 800;
            border: none;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #ffffff;
            min-width: 88px;
            transition: all .3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(15, 60, 77, 0.25);
            letter-spacing: 0.3px;
        }

        .btn-status:hover {
            box-shadow: 0 12px 28px rgba(15, 60, 77, 0.35);
            transform: translateY(-3px);
        }

        .btn-status:active {
            transform: translateY(-1px);
        }

        .due-text {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* === MODAL === */
        .overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(15, 23, 42, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 30;
            backdrop-filter: blur(6px);
        }

        .custom-modal {
            width: 92%;
            max-width: 380px;
            background: linear-gradient(135deg, #f1fbff 0%, rgba(255, 255, 255, 0.98) 100%);
            border-radius: 20px;
            padding: 16px 18px 18px;
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.30), 0 0 1px rgba(0, 196, 214, 0.25) inset;
            border: 1px solid rgba(0, 196, 214, 0.15);
            animation: fadeInUp 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            transition: all 0.3s ease;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .modal-title {
            font-weight: 800;
            font-size: 15px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .modal-close {
            border: none;
            background: transparent;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            color: #9ca3af;
            transition: all .2s ease;
        }

        .modal-close:hover {
            color: var(--primary);
        }

        .modal-body {
            display: grid;
            gap: 10px;
        }

        .detail-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .detail-row i {
            color: var(--primary);
            margin-top: 2px;
        }

        .detail-box {
            background: #fff;
            border: 1px solid #eef2ff;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 12px;
            color: #111827;
            box-shadow: inset 0 0 0 1px rgba(79, 70, 229, .04);
            flex: 1;
        }

        .note-area {
            width: 100%;
            min-height: 120px;
            border-radius: 10px;
            border: 1px solid #eef2ff;
            padding: 10px;
            font-size: 12px;
            resize: vertical;
            background: #fff;
        }

        @media (max-width: 380px) {
            .meta-grid {
                grid-template-columns: 1fr;
            }

            .order-actions {
                min-width: 130px;
            }
        }
    </style>
</head>

<body>
    <div class="screen">

        {{-- === TOP BAR === --}}
        <div class="top-bar">
            <div class="search-wrapper">
                <div class="search-container">
                    <span class="search-icon"><i class="bi bi-search"></i></span>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search">
                </div>
            </div>

            <button class="menu-btn" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>

            {{-- Dropdown menu --}}
            <div class="menu-dropdown" id="menuDropdown">
                <a href="{{ route('pesanan.riwayat') }}" class="menu-item">
                    <i class="bi bi-clock-history"></i> Riwayat Pesanan
                </a>

                <div class="menu-item" onclick="document.getElementById('logoutForm').submit();"><i
                        class="bi bi-box-arrow-right"></i> Sign Out</div>
            </div>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>

        {{-- === TABS === --}}
        <div class="tab-wrapper">
            <div class="tab-pill">
                <button class="tab-btn active" data-tab="Pick up">Ambil</button>
                <button class="tab-btn" data-tab="delivery">Delivery</button>
            </div>
        </div>

        {{-- === ORDER LIST === --}}
        <div class="content" id="orderList">
            @foreach ($orders as $order)
                <div class="order-card" data-type="{{ $order['jenis'] }}" data-name="{{ $order['nama'] }}"
                    data-phone="{{ $order['telepon'] }}" data-address="{{ $order['alamat'] }}"
                    data-note="{{ $order['catatan'] }}">
                    <div class="order-main">
                        <div class="order-title">Pelanggan: <span>{{ $order['nama'] }}</span></div>
                        <div class="order-phone">{{ $order['telepon'] }}</div>
                        <div class="meta-grid">
                            <div class="meta-item"><span class="meta-label">Berat</span><span
                                    class="meta-value">{{ $order['berat'] }} kg</span></div>
                            <div class="meta-item"><span class="meta-label">Harga</span><span class="meta-value">Rp
                                    {{ $order['harga'] }}</span></div>
                            <div class="meta-item"><span class="meta-label">Jumlah</span><span
                                    class="meta-value">{{ $order['jumlah'] }} pcs</span></div>
                            <div class="meta-item"><span class="meta-label">Kategori</span><span
                                    class="meta-value">{{ $order['kategori'] }}</span></div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <div class="order-actions-top">
                            <button class="icon-btn btn-detail"><i class="bi bi-person-vcard"></i></button>
                            <button class="icon-btn btn-note"><i class="bi bi-journal-text"></i></button>
                            <span class="badge-service">{{ $order['paket'] }}</span>
                        </div>

                        <div class="text-end mt-2">
                            <form action="{{ route('pesanan.selesai', $order['id']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-status"
                                    onclick="return confirm('Tandai pesanan ini sebagai selesai?')">Selesai</button>
                            </form>
                            <div class="due-text">Due: {{ $order['due'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="empty-state" id="emptyState" style="display:none;">Tidak ada pesanan</div>
        </div>

        {{-- === SHARED NAVBAR === --}}
        @include('layouts.navbar')

        {{-- === MODAL OVERLAY === --}}
        <div class="overlay" id="overlay">
            {{-- Customer Details --}}
            <div class="custom-modal" id="modalDetails" style="display:none;">
                <div class="modal-header">
                    <div class="modal-title">Customer Details</div>
                    <button class="modal-close" data-close>&times;</button>
                </div>
                <div class="modal-body">
                    <div class="detail-row"><i class="bi bi-person"></i>
                        <div class="detail-box" id="detailName"></div>
                    </div>
                    <div class="detail-row"><i class="bi bi-telephone"></i>
                        <div class="detail-box" id="detailPhone"></div>
                    </div>
                    <div class="detail-row"><i class="bi bi-geo-alt"></i>
                        <div class="detail-box" id="detailAddress"></div>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="custom-modal" id="modalNote" style="display:none;">
                <div class="modal-header">
                    <div class="modal-title">Catatan</div>
                    <button class="modal-close" data-close>&times;</button>
                </div>
                <div class="modal-body">
                    <textarea class="note-area" id="noteContent" readonly></textarea>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Dropdown
        const menuToggle = document.getElementById('menuToggle');
        const menuDropdown = document.getElementById('menuDropdown');

        menuToggle.addEventListener('click', () => {
            menuDropdown.style.display =
                menuDropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (e) => {
            if (!menuDropdown.contains(e.target) && !menuToggle.contains(e.target)) {
                menuDropdown.style.display = 'none';
            }
        });

        // Tabs + Search combined filter
        const tabButtons = document.querySelectorAll('.tab-btn');
        const orders = document.querySelectorAll('.order-card');
        const searchInput = document.getElementById('searchInput');
        const emptyState = document.getElementById('emptyState');

        function applyFilters() {
            const activeTab = document.querySelector('.tab-btn.active')?.dataset.tab || 'pickup';
            const q = searchInput.value.trim().toLowerCase();
            let visibleCount = 0;
            orders.forEach(card => {
                const matchTab = card.dataset.type === activeTab;
                const matchSearch = !q || card.dataset.name.toLowerCase().includes(q);
                const visible = matchTab && matchSearch;
                card.style.display = visible ? 'flex' : 'none';
                if (visible) visibleCount++;
            });
            if (emptyState) emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                tabButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                applyFilters();
            });
        });

        searchInput.addEventListener('input', applyFilters);

        // initial filter
        applyFilters();

        // Modals
        const overlay = document.getElementById('overlay');
        const modalDetails = document.getElementById('modalDetails');
        const modalNote = document.getElementById('modalNote');

        overlay.addEventListener('click', (e) => {
            if (e.target === overlay || e.target.hasAttribute('data-close')) {
                overlay.style.display = 'none';
                modalDetails.style.display = 'none';
                modalNote.style.display = 'none';
            }
        });

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.order-card');
                document.getElementById('detailName').textContent = card.dataset.name;
                document.getElementById('detailPhone').textContent = card.dataset.phone;
                document.getElementById('detailAddress').textContent = card.dataset.address;

                modalNote.style.display = 'none';
                modalDetails.style.display = 'block';
                overlay.style.display = 'flex';
            });
        });

        document.querySelectorAll('.btn-note').forEach(btn => {
            btn.addEventListener('click', () => {
                const card = btn.closest('.order-card');
                document.getElementById('noteContent').value = card.dataset.note;
                modalDetails.style.display = 'none';
                modalNote.style.display = 'block';
                overlay.style.display = 'flex';
            });
        });
    </script>

</body>

</html>
