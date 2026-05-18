<!-- NRP: 5026231206| Nama: Rafael Dimas Khristianto (membantu memperbaiki UI/UX) -->
<!-- 5026231208 - Alfan Ghofari Prasanna Firmasyah -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Keuangan</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Poppins Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Shared navbar styles --}}
  @include('layouts.nav-styles')

  <style>
    /* ========== FORCE GLOBAL FONT POPPINS ========== */
    :root {
      --bs-body-font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif !important;
      --bg: #f0f4ff;
      --nav-bg: #0d9488;
      --nav-active: #14b8a6;
      --pill-bg: #0d9488;
      --text: #111827;
      --primary: #0d9488;
      --fab-blue: #14b8a6;
      --accent: #14b8a6;
      --success: #10b981;
      --error: #ef4444;
      --card: #ffffff;
    }

    * {
      font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, sans-serif !important;
    }

    /* Animations */
    @keyframes fadeInUp {
      from { opacity:0; transform:translateY(20px); }
      to { opacity:1; transform:translateY(0); }
    }
    @keyframes slideInLeft {
      from { opacity:0; transform:translateX(-20px); }
      to { opacity:1; transform:translateX(0); }
    }
    @keyframes slideInRight {
      from { opacity:0; transform:translateX(20px); }
      to { opacity:1; transform:translateX(0); }
    }
    @keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.7;} }

    /* Base Layout */
    body {
      background: #f5f5f5;
      color: var(--text);
      font-family: 'Poppins', sans-serif !important;
    }

    html, body, button, input, select, textarea, a, p, span, div, h1, h2, h3, h4, h5, h6, small, strong, em, label {
      font-family: 'Poppins', sans-serif !important;
    }

    .phone-app {
      max-width: 420px;
      margin: 18px auto;
      min-height: calc(100vh - 36px);
      display: flex;
      flex-direction: column;
      position: relative;
    }

    /* Header */
    .top-header {
      background: #f9f9f9;
      border-radius: 36px;
      padding: 14px 18px;
      margin: 8px;
      box-shadow: 0 18px 40px rgba(13, 148, 136, 0.08), inset 0 -6px 18px rgba(255,255,255,0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeInUp .45s ease-out;
      border: 1px solid rgba(79,70,229,.08);
      transition: transform .18s ease, box-shadow .18s ease;
    }
    .top-header:hover {
      transform: translateY(-4px);
      box-shadow: 0 26px 54px rgba(13, 148, 136, .12);
    }

    .top-title {
      font-weight: 500;
      font-size: 1.18rem;
      margin: 0;
      background: linear-gradient(135deg, var(--primary), var(--fab-blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      letter-spacing: 0.4px;
    }
    .top-sub {
      margin: 4px 0 0;
      font-size: 0.86rem;
      color: rgba(15,23,42,0.6);
      font-weight: 400;
    }

    .top-header .header-inner {
      text-align: center;
      padding: 8px 10px;
    }

    /* Content Area */
    .content {
      padding: 10px 16px 110px;
    }

    /* Buttons */
    .btn-main {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
      background: linear-gradient(135deg, var(--primary), var(--fab-blue));
      color: #fff;
      border: none;
      border-radius: 26px;
      padding: 12px 1.2rem;
      font-weight: 500;
      text-align: center;
      box-shadow: 0 18px 40px rgba(13, 148, 136, .12);
      animation: fadeInUp .45s ease-out backwards;
      transition: transform .18s ease, box-shadow .18s ease;
      cursor: pointer;
      font-size: 0.98rem;
      text-decoration: none !important;
    }

    .btn-main i {
      background: rgba(255,255,255,0.12);
      padding: 8px;
      border-radius: 10px;
    }

    .btn-main:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(79,70,229,.3);
    }

    .btn-main + .btn-main { margin-top: 12px; }
    .btn-main:nth-of-type(1){ animation-delay:.1s; }
    .btn-main:nth-of-type(2){ animation-delay:.2s; }

    /* Section Title */
    .section-title {
      font-weight: 500;
      font-size: 1.02rem;
      color: var(--text);
      animation: fadeInUp .45s ease-out .22s both;
      padding-left: 6px;
    }

    /* Filter */
    .filter-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .select-light {
      position: relative;
    }
    .select-light select {
      appearance: none;
      border: 1px solid rgba(15,23,42,0.06);
      background: var(--card);
      color: #334155;
      border-radius: 10px;
      padding: .45rem 2.1rem .45rem .9rem;
      font-size: .92rem;
      transition: all .18s ease;
      cursor: pointer;
      box-shadow: 0 6px 18px rgba(16,24,40,0.04);
    }

    .select-light .caret {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #333;
      pointer-events: none;
    }

    /* List Card */
    .list-card {
      background: var(--card);
      border-radius: 14px;
      box-shadow: 0 8px 30px rgba(79,70,229,.06);
      padding: 12px 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      animation: fadeInUp .4s ease-out backwards;
      border: 1px solid rgba(15,23,42,0.04);
      transition: transform .18s ease, box-shadow .18s ease;
    }

    .list-card:hover {
      box-shadow: 0 20px 50px rgba(79,70,229,.08);
      transform: translateY(-6px);
    }

    .list-left .code {
      font-size: .92rem;
      color: #64748b;
      font-weight: 500;
      letter-spacing: 0.6px;
    }
    .list-left .amount.pos {
      color: var(--success);
      font-weight: 500;
      font-size: 1.02rem;
    }
    .list-left .amount.neg {
      color: var(--error);
      font-weight: 500;
      font-size: 1.02rem;
    }
    .amount {
    font-family: 'Poppins', sans-serif !important;
    font-weight: 500 !important;
    font-size: 1.06rem;
    letter-spacing: 0.2px;
    }

    .list-right {
      text-align: right;
    }
    .list-right .date {
      font-size: .84rem;
      color: #94a3b8;
      margin-bottom: .25rem;
    }

    .detail-btn {
      background: linear-gradient(135deg, var(--primary), var(--fab-blue));
      color: #fff;
      border: none;
      padding: .45rem .95rem;
      border-radius: 14px;
      font-weight: 500;
      transition: transform .12s ease, box-shadow .12s ease;
      cursor: pointer;
      box-shadow: 0 8px 26px rgba(79,70,229,.08);
    }
    .detail-btn:hover {
      box-shadow: 0 14px 34px rgba(79,70,229,.12);
      transform: translateY(-3px);
    }

    /* Detail Modal */
    #detailModal .modal-content { border-radius:20px; box-shadow: 0 20px 60px rgba(79,70,229,.15); border: 1px solid rgba(79,70,229,.1); overflow:hidden; }
    #detailModal .modal-header { background: linear-gradient(135deg, #f0f4ff, rgba(240,244,255,.8)); border-bottom: 1px solid rgba(79,70,229,.1); }
    #detailModal .modal-title { font-weight:500; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    #detailModal .modal-body { background: var(--bg); padding: 14px 16px; }
    #detailModal .modal-dialog { max-width: 380px; margin: 0 auto; }
    .modal-backdrop.show { background-color: rgba(15,23,42,.5); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    .order-chip, .date-chip { background:#fff; border:1px solid rgba(79,70,229,.12); border-radius:12px; padding:6px 10px; font-weight:500; color:var(--text); box-shadow: 0 6px 18px rgba(79,70,229,.06); }
    .detail-row { display:flex; align-items:center; justify-content:space-between; padding:8px 0; border-bottom:1px dashed rgba(15,23,42,0.06); }
    .detail-row:last-child { border-bottom:none; }
    .detail-row .label { color:#64748b; font-weight:400; }
    .detail-row .value { color:var(--text); font-weight:500; }
  </style>
</head>

<body>
  <div class="phone-app">

    <div class="top-header">
      <div class="header-inner">
        <h1 class="top-title">Keuangan</h1>
        <p class="top-sub">Ringkasan & aktivitas terbaru</p>
      </div>
    </div>

    <main class="content">
      @if(session('status'))
        <div class="alert alert-success" role="alert" style="border-radius:12px;">{{ session('status') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger" role="alert" style="border-radius:12px;">{{ $errors->first() }}</div>
      @endif

      <div class="mb-3" style="background:#fff;border-radius:16px;box-shadow:0 8px 20px rgba(79,70,229,.08);padding:12px 14px;border:1px solid rgba(15,23,42,0.06);">
        <div class="d-flex align-items-center justify-content-end gap-2">
          <button type="button" class="detail-btn" data-bs-toggle="modal" data-bs-target="#incomeModal">Tambah pemasukan</button>
          <button type="button" class="detail-btn" data-bs-toggle="modal" data-bs-target="#expenseModal">Tambah pengeluaran</button>
        </div>
      </div>
      <a class="btn-main" href="{{ route('grafik.keuangan') }}">
        <i class="bi bi-bar-chart-line-fill"></i>
        <span class="btn-label">Grafik Keuangan</span>
      </a>

      <a class="btn-main" href="{{ route('aliran.kas') }}">
        <i class="bi bi-cash-stack"></i>
        <span class="btn-label">Aliran Kas</span>
      </a>

      <h6 class="section-title mt-3">Riwayat Keuangan</h6>

      <div class="filter-wrap">
        <span class="mini-label me-2">Filter</span>

        <div class="select-light d-inline-block">
          <select id="filterType" class="w-auto">
            <option value="all" selected>Semua</option>
            <option value="PEMASUKAN">Pemasukan</option>
            <option value="PENGELUARAN">Pengeluaran</option>
          </select>
          <i class="bi bi-caret-down-fill caret"></i>
        </div>
      </div>

      <div class="vstack gap-3">
        @if(isset($history) && count($history))
          @foreach($history as $row)
            @php $isIncome = ($row->tipe === 'pemasukan'); $amtClass = $isIncome ? 'pos' : 'neg'; $ts = $row->tanggal ? strtotime($row->tanggal) : null; $dateStr = $ts ? date('d/m/Y', $ts) : '-'; @endphp
            <div class="list-card" data-code="{{ strtoupper($row->tipe) }}" data-date="{{ $dateStr }}">
              <div class="list-left">
                <div class="code">{{ strtoupper($row->tipe) }}</div>
                <div class="amount {{ $amtClass }}">Rp {{ number_format((int)$row->jumlah, 0, ',', '.') }}</div>
              </div>
              <div class="list-right">
                <div class="date">{{ $dateStr }}</div>
                <button class="detail-btn" data-action="show-detail">Detail <i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
          @endforeach
        @else
          <div class="list-card">
            <div class="list-left">
              <div class="code">DATA</div>
              <div class="amount pos">Rp 0</div>
            </div>
            <div class="list-right">
              <div class="date">-</div>
            </div>
          </div>
        @endif
      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; overflow:hidden;">
          <div class="modal-header">
            <h5 class="modal-title">Detail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-between mb-2">
              <span id="dOrder" class="order-chip">-</span>
              <span id="dDate" class="date-chip">-</span>
            </div>

            <div class="detail-row"><span class="label">Nama</span><span id="dName" class="value">-</span></div>
            <div class="detail-row"><span class="label">No Telp</span><span id="dPhone" class="value">-</span></div>
            <div class="detail-row"><span class="label">Alamat</span><span id="dAddress" class="value">-</span></div>
            <div class="detail-row"><span class="label">Kategori Produk</span><span id="dCategory" class="value">-</span></div>
            <div class="detail-row"><span class="label">Ongkir</span><span id="dShipping" class="value">-</span></div>
            <div class="detail-row"><span class="label">Kasir</span><span id="dCashier" class="value">-</span></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Income Modal -->
    <div class="modal fade" id="incomeModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; overflow:hidden;">
          <form method="POST" action="{{ route('keuangan.pemasukan.store') }}">
            @csrf
            <div class="modal-header" style="background:#fff;">
              <h5 class="modal-title">Tambah Pemasukan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="background:var(--bg);">
              <div class="mb-3">
                <label for="incomeAmount" class="form-label">Jumlah (Rp)</label>
                <input type="number" min="1" step="1" class="form-control" id="incomeAmount" name="jumlah" placeholder="Masukkan nominal" required>
              </div>
              <div class="mb-3">
                <label for="incomeDate" class="form-label">Tanggal (opsional)</label>
                <input type="datetime-local" class="form-control" id="incomeDate" name="tanggal" />
              </div>
              <div class="mb-3">
                <label for="incomeNote" class="form-label">Catatan (opsional)</label>
                <textarea class="form-control" id="incomeNote" name="catatan" placeholder="Misal: pemasukan manual"></textarea>
              </div>
            </div>
            <div class="modal-footer" style="background:#fff;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Expense Modal -->
    <div class="modal fade" id="expenseModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px; overflow:hidden;">
          <form method="POST" action="{{ route('keuangan.pengeluaran.store') }}">
            @csrf
            <div class="modal-header" style="background:#fff;">
              <h5 class="modal-title">Tambah Pengeluaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="background:var(--bg);">
              <div class="mb-3">
                <label for="expenseAmount" class="form-label">Jumlah (Rp)</label>
                <input type="number" min="1" step="1" class="form-control" id="expenseAmount" name="jumlah" placeholder="Masukkan nominal" required>
              </div>
              <div class="mb-3">
                <label for="expenseCategory" class="form-label">Kategori</label>
                <select class="form-select" id="expenseCategory" name="kategori" required>
                  <option value="Listrik">Listrik</option>
                  <option value="Detergen">Detergen</option>
                  <option value="Air">Air</option>
                  <option value="Sewa Tempat">Sewa Tempat</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="expenseDate" class="form-label">Tanggal (opsional)</label>
                <input type="datetime-local" class="form-control" id="expenseDate" name="tanggal" />
              </div>
              <div class="mb-3">
                <label for="expenseNote" class="form-label">Catatan (opsional)</label>
                <textarea class="form-control" id="expenseNote" name="catatan" placeholder="Misal: pengeluaran manual"></textarea>
              </div>
            </div>
            <div class="modal-footer" style="background:#fff;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Navbar --}}
    @include('layouts.navbar')

  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const rupiah = (n)=> new Intl.NumberFormat('id-ID', { style:'currency', currency:'IDR', minimumFractionDigits:0 }).format(n);
    const modalEl = document.getElementById('detailModal');
    const modal = new bootstrap.Modal(modalEl);

    function showDetail(card){
      const code = card.dataset.code || '-';
      const date = card.dataset.date || '-';
      const name = card.dataset.name || '-';
      const phone = card.dataset.phone || '-';
      const address = (card.dataset.address || '-').replace(/\n/g,'<br>');
      const category = card.dataset.category || '-';
      const dist = parseFloat(card.dataset.distance||'0');
      const rate = parseInt(card.dataset.rate||'0',10);
      const ship = dist * rate;

      document.getElementById('dOrder').textContent = code;
      document.getElementById('dDate').textContent = date;
      document.getElementById('dName').textContent = name;
      document.getElementById('dPhone').textContent = phone;
      document.getElementById('dAddress').innerHTML = address;
      document.getElementById('dCategory').textContent = category;
      document.getElementById('dCashier').textContent = card.dataset.cashier || '-';
      document.getElementById('dShipping').textContent = `${dist.toFixed(2)} KM @${rate} = ${rupiah(ship)}`;

      modal.show();
    }

    document.querySelectorAll('.list-card .detail-btn').forEach(btn=>{
      btn.addEventListener('click', (e)=>{
        const card = e.currentTarget.closest('.list-card');
        if(card) showDetail(card);
      });
    });

    const filterSel = document.getElementById('filterType');
    function applyFilter(){
      const v = filterSel ? filterSel.value : 'all';
      document.querySelectorAll('.list-card').forEach(card=>{
        const code = card.dataset.code || '';
        if (v === 'all') { card.style.display = ''; }
        else { card.style.display = (code === v) ? '' : 'none'; }
      });
    }
    if (filterSel) {
      filterSel.addEventListener('change', applyFilter);
      applyFilter();
    }
  </script>
</body>
</html>
