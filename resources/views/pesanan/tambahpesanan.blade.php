

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @include('layouts.nav-styles')

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

    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f5f5f5;
      min-height: 100vh;
      padding-bottom: 100px;
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

    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .container {
      max-width: 480px;
      margin: 0 auto;
    }

    .header-section {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 0 0 28px 28px;
      padding: 20px;
      margin: -20px -12px 0 -12px;
      color: #fff;
      text-align: center;
      animation: slideInDown 0.6s ease-out;
      box-shadow: 0 8px 24px rgba(13, 148, 136, 0.2);
    }

    .header-section h1 {
      font-weight: 700;
      font-size: 1.5rem;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }

    .form-card {
      background: #fff;
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 4px 16px rgba(13, 148, 136, 0.12);
      margin-top: 24px;
      border: 1px solid rgba(13, 148, 136, 0.1);
      animation: fadeInUp 0.6s ease-out;
    }

    .alert {
      border-radius: 12px;
      border: none;
      animation: fadeInUp 0.4s ease-out;
      margin-bottom: 20px;
    }

    .alert-success {
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
      color: var(--success);
      border-left: 4px solid var(--success);
    }

    .form-group {
      margin-bottom: 18px;
      animation: fadeInUp 0.6s ease-out;
    }

    .form-group:nth-child(1) {
      animation-delay: 0.1s;
    }

    .form-group:nth-child(2) {
      animation-delay: 0.15s;
    }

    .form-group:nth-child(3) {
      animation-delay: 0.2s;
    }

    .form-group:nth-child(4) {
      animation-delay: 0.25s;
    }

    .form-group:nth-child(5) {
      animation-delay: 0.3s;
    }

    .form-group:nth-child(6) {
      animation-delay: 0.35s;
    }

    .form-group:nth-child(7) {
      animation-delay: 0.4s;
    }

    .form-group:nth-child(8) {
      animation-delay: 0.45s;
    }

    .form-label {
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .form-control,
    .form-select {
      border: 2px solid rgba(79, 70, 229, 0.2);
      border-radius: 12px;
      padding: 0.75rem 1rem;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      background-color: #fff;
      color: var(--text-main);
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
      outline: none;
    }

    .form-control::placeholder {
      color: var(--text-muted);
      font-weight: 500;
    }

    .form-select option {
      color: var(--text-main);
    }

    .form-group .form-control:hover,
    .form-group .form-select:hover {
      border-color: var(--secondary);
    }

    textarea.form-control {
      resize: vertical;
      min-height: 100px;
    }

    .button-group {
      display: flex;
      gap: 12px;
      margin-top: 28px;
      animation: fadeInUp 0.8s ease-out;
    }

    .btn {
      border-radius: 12px;
      font-weight: 600;
      padding: 0.85rem 1.8rem;
      border: none;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-size: 1rem;
    }

    .btn-success {
      background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
      flex: 1;
    }

    .btn-success:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
      color: #fff;
    }

    .btn-secondary {
      background: rgba(79, 70, 229, 0.1);
      color: var(--primary);
      border: 2px solid rgba(79, 70, 229, 0.2);
      flex: 1;
    }

    .btn-secondary:hover {
      background: rgba(79, 70, 229, 0.15);
      border-color: var(--primary);
      transform: translateY(-2px);
      color: var(--primary);
    }

    .row {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .col-md-6,
    .col-md-12 {
      flex: 1;
    }

    @include('layouts.nav-styles')
    ;
  </style>
</head>

<body>

  <div class="container py-4">
    <div class="header-section">
      <h1><i class="bi bi-plus-circle"></i> Tambah Pesanan</h1>
    </div>

    <div class="form-card">
      @if(session('success'))
        <div class="alert alert-success">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-check-circle"></i>
            <span>{{ session('success') }}</span>
          </div>
        </div>
      @endif

      <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="row g-0">

          <div class="form-group">
            <label for="pelanggan" class="form-label">
              <i class="bi bi-person-fill"></i> Nama Pelanggan
            </label>
            <select id="pelanggan" name="pelanggan_id" class="form-select" required>
              <option value="">-- Pilih Pelanggan --</option>
              @foreach($pelanggans as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="kategori" class="form-label">
              <i class="bi bi-tag-fill"></i> Kategori
            </label>
            <select id="kategori" class="form-select">
              <option value="">Pilih Kategori</option>
              @foreach ($kategoris as $k)
                <option value="{{ $k->IDKategori }}">{{ $k->Nama_Kategori }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">
              <i class="bi bi-box-fill"></i> Paket
            </label>

            <select id="paket" name="paket_id" class="form-select" required>
              <option value="">-- Pilih Paket --</option>
            </select>

          </div>

          <div class="form-group">
            <label for="jumlah" class="form-label">
              <i class="bi bi-hash"></i> Jumlah
            </label>
            <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Masukkan jumlah item"
              required>
          </div>

          <div class="form-group">
            <label for="berat" class="form-label">
              <i class="bi bi-weight"></i> Berat (kg)
            </label>
            <input type="number" step="0.1" id="berat" name="berat" class="form-control" placeholder="Masukkan berat"
              required>
          </div>

          <!-- <div class="form-group">
            <label for="penjemputan" class="form-label">
              <i class="bi bi-truck"></i> Penjemputan
            </label>
            <select id="penjemputan" name="penjemputan" class="form-select">
              <option value="Tidak">Tidak</option>
              <option value="Ya">Ya</option>
            </select>
          </div> -->

          <div class="form-group">
            <label for="pengiriman" class="form-label">
              <i class="bi bi-box-seam"></i> Pengiriman
            </label>
            <select id="pengiriman" name="pengiriman" class="form-select">
              <option value="Ambil">Tidak</option>
              <option value="Pengiriman">Ya</option>
            </select>
          </div>

          <div class="form-group">
            <label for="catatan" class="form-label">
              <i class="bi bi-chat-left-text"></i> Catatan
            </label>
            <textarea id="catatan" name="catatan" class="form-control"
              placeholder="Masukkan catatan tambahan (opsional)"></textarea>
          </div>

        </div>

        <div class="button-group">
          <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
          <button type="submit" class="btn btn-success"><i class="bi bi-check2"></i> Simpan</button>
        </div>
      </form>

    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const paketData = @json($pakets);

    document.getElementById('kategori').addEventListener('change', function () {
      const kategoriId = this.value;
      const paketSelect = document.getElementById('paket');

      paketSelect.innerHTML = '<option value="">Pilih Paket</option>';

      if (!kategoriId || !paketData[kategoriId]) return;

      paketData[kategoriId].forEach(paket => {
        const option = document.createElement('option');
        option.value = paket.IDPaket;
        option.textContent = `${paket.Jenis_Layanan} - Rp ${paket.HargaPerKg.toLocaleString()}/kg`;
        paketSelect.appendChild(option);
      });
    });
  </script>

@include('layouts.navbar')
</body>

</html>
