
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Aliran Kas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --primary: #0d9488;
      --secondary: #14b8a6;
      --fab-blue: #14b8a6;
      --accent: #14b8a6;
      --success: #10b981;
      --error: #ef4444;
      --bg-main: #f5f5f5;
      --text-main: #111827;
      --text-muted: #6b7280;
      --card:#ffffff;
    }

    * { font-family: 'Poppins', sans-serif; }
    html, body, button, input, select, textarea, a, p, span, div, h1, h2, h3, h4, h5, h6, small, strong, em, label { font-family: 'Poppins', sans-serif !important; }
    body { background: #f5f5f5; min-height: 100vh; }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .phone-app { max-width: 480px; margin: 0 auto; min-height: 100vh; display: flex; flex-direction: column; position: relative; }

    .top-header {
      background: #f9f9f9;
      border-radius: 36px;
      padding: 14px 18px;
      margin: 8px;
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 18px 40px rgba(13, 148, 136, 0.08), inset 0 -6px 18px rgba(255,255,255,0.25);
      animation: slideInDown 0.6s ease-out;
      border: 1px solid rgba(13,148,136,0.08);
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

    .back-btn {
      color: var(--primary);
      font-size: 1.3rem;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .back-btn:hover {
      transform: scale(1.1);
      filter: brightness(0.9);
    }

    .content { padding: 20px 18px 100px; }

    .section-title {
      font-weight: 500;
      font-size: 1.02rem;
      color: var(--text-main);
      margin-bottom: 12px;
    }

    .mini-label {
      font-size: 0.9rem;
      color: var(--text-muted);
      font-weight: 500;
    }

    .select-pill { position: relative; display: inline-block; }
    .select-pill select {
      appearance: none; -webkit-appearance:none; -moz-appearance:none;
      border: 1px solid rgba(15,23,42,0.06);
      background: var(--card);
      color: #334155;
      font-weight: 500;
      border-radius: 10px;
      padding: 0.5rem 2.2rem 0.5rem 0.9rem;
      font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 6px 18px rgba(16,24,40,0.04);
    }
    .select-pill select:hover { box-shadow: 0 10px 22px rgba(16,24,40,0.08); border-color: rgba(15,23,42,0.12); }
    .select-pill select:focus { outline:none; box-shadow: 0 0 0 3px rgba(13,148,136,0.1), 0 4px 12px rgba(13,148,136,0.12); border-color: rgba(13,148,136,0.18); }
    .select-pill .caret { position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#333; font-size:0.9rem; pointer-events:none; }

    .filter-section {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
      animation: fadeInUp 0.6s ease-out;
    }

    .chart-card { background:#fff; border-radius:20px; padding:18px; box-shadow: 0 8px 24px rgba(13,148,136,0.12); margin-bottom:20px; animation: fadeInUp 0.6s ease-out; border:1px solid rgba(13,148,136,0.1); }

    .money-table {
      width: 100%;
      background: #fff;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
      animation: fadeInUp 0.8s ease-out;
    }

    .money-table th, .money-table td {
      padding: 0.85rem 1.2rem;
      border: 1px solid rgba(79, 70, 229, 0.1);
      text-align: left;
    }

    .money-table th { background: rgba(13,148,136,0.08); font-weight: 500; color: var(--primary); width:40%; }

    .money-table td { color: var(--text-main); font-weight: 500; background: #fafbff; }

    .money-table tr:hover {
      background: linear-gradient(90deg, rgba(79, 70, 229, 0.04), transparent);
    }

    section { animation: fadeInUp 0.6s ease-out; }

    @include('layouts.nav-styles');
  </style>
</head>
<body>
  <div class="phone-app">
    <!-- Top header -->
    <div class="top-header">
      <a class="back-btn" href="{{ route('keuangan') }}" aria-label="Kembali"><i class="bi bi-arrow-left"></i></a>
      <h1 class="top-title">Aliran Kas</h1>
      <div class="ms-auto"></div>
    </div>

    <main class="content">
      <section>
        <div class="filter-section">
          <h6 class="section-title mb-0">Cash Flow</h6>
          <div class="d-flex align-items-center gap-2">
            <span class="mini-label">Filter:</span>
            <div class="select-pill">
              <select id="monthSel"></select>
              <i class="bi bi-caret-down-fill caret"></i>
            </div>
          </div>
        </div>

        <div class="chart-card">
          <canvas id="pieChart" height="170"></canvas>
        </div>

        <table class="money-table">
          <tbody>
            <tr><th>Listrik</th><td id="mListrik">-</td></tr>
            <tr><th>Detergen</th><td id="mDetergen">-</td></tr>
            <tr><th>Air</th><td id="mAir">-</td></tr>
            <tr><th>Sewa Tempat</th><td id="mSewa">-</td></tr>
            <tr><th>Total Pengeluaran</th><td id="mTotal" style="font-weight: 700; background: linear-gradient(90deg, rgba(79, 70, 229, 0.1), transparent); color: var(--primary);">-</td></tr>
            <tr><th>Total Pemasukan</th><td id="mIncome" style="font-weight: 700; background: linear-gradient(90deg, rgba(16, 185, 129, 0.1), transparent); color: var(--success);">-</td></tr>
            <tr><th>Laba</th><td id="mProfit" style="font-weight: 700; background: linear-gradient(90deg, rgba(0, 196, 214, 0.1), transparent); color: var(--accent);">-</td></tr>
          </tbody>
        </table>
      </section>
    </main>

    @include('layouts.navbar')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    const months = {!! json_encode($months) !!};
    const expenseDataByMonth = {!! json_encode($expenseDataByMonth) !!};
    const rupiah = (n)=> new Intl.NumberFormat('id-ID', { style:'currency', currency:'IDR', minimumFractionDigits:0 }).format(n);
    const monthSel = document.getElementById('monthSel');
    months.forEach(m=>{ const o=document.createElement('option'); o.value=m; o.textContent=m; monthSel.appendChild(o); });
    monthSel.value = months[months.length-1] || '';

    const pieCtx = document.getElementById('pieChart');
    let pieChart;

    function updateView(){
      const m = monthSel.value;
      const d = expenseDataByMonth[m] || expenseDataByMonth[months[months.length-1]] || {};
      const num = (v)=> (typeof v==='number' && isFinite(v)) ? v : 0;
      const listrik = num(d.Listrik);
      const detergen = num(d.Detergen);
      const air = num(d.Air);
      const sewa = num(d.Sewa);
      const income = num(d.income);
      const total = Object.keys(d).reduce((s,k)=> k==='income' ? s : s + num(d[k]), 0);
      const profit = income - total;

      document.getElementById('mListrik').textContent = rupiah(listrik);
      document.getElementById('mDetergen').textContent = rupiah(detergen);
      document.getElementById('mAir').textContent = rupiah(air);
      document.getElementById('mSewa').textContent = rupiah(sewa);
      document.getElementById('mTotal').textContent = rupiah(total);
      document.getElementById('mIncome').textContent = rupiah(income);
      document.getElementById('mProfit').textContent = rupiah(profit);

      const keys = Object.keys(d).filter(k=>k !== 'income');
      const values = keys.map(k=> num(d[k]));
      const palette = ['#0d9488', '#14b8a6', '#f59e0b', '#ef4444', '#10b981', '#10b981'];
      const colors = keys.map((_,i)=> palette[i % palette.length]);
      const labels = [...keys, 'Total Pemasukan'];
      const vals = [...values, income];
      const displayColors = [...colors, '#10b981'];

      const data = {
        labels: labels,
        datasets: [{
          data: vals,
          backgroundColor: displayColors,
          borderColor: '#fff',
          borderWidth: 2
        }]
      };

      const options = {
        plugins: {
          legend: {
            position: 'right',
            labels: {
              boxWidth: 12,
              font: { weight: 600, size: 12 },
              color: 'var(--text-main)',
              padding: 12
            }
          },
          tooltip: {
            backgroundColor: 'rgba(79, 70, 229, 0.9)',
            padding: 12,
            cornerRadius: 8,
            titleFont: { weight: 600 },
            callbacks: { label: (ctx)=> `${ctx.label}: ${rupiah(ctx.parsed)}` }
          }
        },
        responsive: true,
        maintainAspectRatio: true
      };

      if (pieChart) {
        pieChart.data = data;
        pieChart.update();
      } else {
        pieChart = new Chart(pieCtx, { type: 'doughnut', data, options });
      }
    }

    monthSel.addEventListener('change', updateView);
    monthSel.addEventListener('input', updateView);
    updateView();
  </script>
</body>
</html>
