
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Grafik Keuangan</title>
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
      --card: #ffffff;
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

    @keyframes popIn {
      0% { transform: scale(0.8); opacity: 0; }
      70% { transform: scale(1.1); }
      100% { transform: scale(1); opacity: 1; }
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
      box-shadow: 0 18px 40px rgba(79, 70, 229, 0.08), inset 0 -6px 18px rgba(255,255,255,0.25);
      animation: slideInDown 0.6s ease-out;
      border: 1px solid rgba(79, 70, 229, 0.08);
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

    .select-pill {
      position: relative;
      display: inline-block;
    }

    .select-pill select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      border: 1px solid rgba(15,23,42,0.06);
      background: var(--card);
      color: #334155;
      font-weight: 500;
      border-radius: 10px;
      padding: 0.5rem 2.2rem 0.5rem 0.9rem;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 6px 18px rgba(16,24,40,0.04);
    }

    .select-pill select:hover {
      box-shadow: 0 10px 22px rgba(16,24,40,0.08);
      border-color: rgba(15,23,42,0.12);
    }

    .select-pill select:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(13,148,136,0.1), 0 4px 12px rgba(13,148,136,0.12);
      border-color: rgba(13,148,136,0.18);
    }

    .select-pill .caret {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #333;
      font-size: 0.9rem;
      pointer-events: none;
    }

    .filter-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
      animation: fadeInUp 0.6s ease-out;
    }

    .chart-card {
      background: #fff;
      border-radius: 20px;
      padding: 18px;
      box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12);
      margin-bottom: 18px;
      animation: fadeInUp 0.6s ease-out;
      border: 1px solid rgba(79, 70, 229, 0.1);
    }

    .btn-group {
      display: flex;
      gap: 12px;
      animation: fadeInUp 0.8s ease-out;
    }

    .btn-pill {
      border-radius: 999px;
      padding: 0.65rem 1.5rem;
      font-weight: 500;
      border: none;
      cursor: pointer;
      font-size: 0.95rem;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-pill.primary {
      background: linear-gradient(135deg, var(--primary), var(--fab-blue));
      color: #fff;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-pill.primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
    }

    .btn-pill.secondary {
      background: rgba(79, 70, 229, 0.1);
      color: var(--primary);
      border: 2px solid rgba(79, 70, 229, 0.2);
    }

    .btn-pill.secondary:hover {
      background: rgba(79, 70, 229, 0.15);
      border-color: var(--primary);
      transform: translateY(-2px);
    }

    section { animation: fadeInUp 0.6s ease-out; margin-bottom: 28px; }
    section:nth-child(1) { animation-delay: 0.1s; }
    section:nth-child(2) { animation-delay: 0.2s; }

    /* Stats Modal */
    .modal-content {
      border-radius: 20px;
      border: 1px solid rgba(79, 70, 229, 0.1);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
      background: linear-gradient(135deg, #f0f4ff, rgba(240,244,255,.8));
      color: var(--text-main);
      border-radius: 20px 20px 0 0;
      border: none;
      padding: 18px 20px;
    }

    .modal-title {
      font-weight: 500;
      font-size: 1.02rem;
      background: linear-gradient(135deg, var(--primary), var(--fab-blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .btn-close {
      filter: brightness(0) invert(1);
    }

    .stats-table {
      width: 100%;
      border-collapse: collapse;
    }

    .stats-table td, .stats-table th {
      padding: 0.8rem 1rem;
      border: 1px solid rgba(79, 70, 229, 0.1);
    }

    .stats-table th {
      background: rgba(79, 70, 229, 0.08);
      font-weight: 500;
      color: var(--primary);
      width: 40%;
    }

    .stats-table td {
      color: var(--text-main);
      font-weight: 500;
    }

    @include('layouts.nav-styles');
  </style>
</head>
<body>
  <div class="phone-app">
    <div class="top-header">
      <a class="back-btn" href="{{ route('keuangan') }}" aria-label="Kembali"><i class="bi bi-arrow-left"></i></a>
      <h1 class="top-title">Grafik Keuangan</h1>
      <div class="ms-auto"></div>
    </div>

    <main class="content">
      <!-- Income Section -->
      <section>
        <div class="filter-section">
          <h6 class="section-title mb-0">Pemasukan</h6>
          <div class="d-flex align-items-center gap-2">
            <span class="mini-label">Filter:</span>
            <div class="select-pill">
              <select id="incomeYear"></select>
              <i class="bi bi-caret-down-fill caret"></i>
            </div>
          </div>
        </div>
        <div class="chart-card">
          <canvas id="incomeChart" height="130"></canvas>
        </div>
        <div class="btn-group">
          <button class="btn-pill primary" id="incomeStatsBtn"><i class="bi bi-table"></i> Tabel</button>
        </div>
      </section>

      <!-- Expense Section -->
      <section>
        <div class="filter-section">
          <h6 class="section-title mb-0">Pengeluaran</h6>
          <div class="d-flex align-items-center gap-2">
            <span class="mini-label">Filter:</span>
            <div class="select-pill">
              <select id="expenseYear"></select>
              <i class="bi bi-caret-down-fill caret"></i>
            </div>
          </div>
        </div>
        <div class="chart-card">
          <canvas id="expenseChart" height="130"></canvas>
        </div>
        <div class="btn-group">
          <button class="btn-pill primary" id="expenseStatsBtn"><i class="bi bi-table"></i> Tabel</button>
        </div>
      </section>

      <!-- Compare Section -->
      <section>
        <div class="filter-section">
          <h6 class="section-title mb-0">Perbandingan</h6>
          <div class="d-flex align-items-center gap-2">
            <span class="mini-label">Atur:</span>
            <a href="#" class="btn-pill secondary" id="compareOpenBtn"><i class="bi bi-shuffle"></i> Bandingkan</a>
          </div>
        </div>
        <div class="chart-card">
          <canvas id="compareChart" height="130"></canvas>
        </div>
      </section>
    </main>

    @include('layouts.navbar')
  </div>

  <!-- Stats Modal -->
  <div class="modal fade" id="statsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statsTitle">Tabel Statistika</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="stats-table">
            <tbody>
              <tr><th>Jumlah</th><td id="mSum">-</td></tr>
              <tr><th>Rata-rata</th><td id="mMean">-</td></tr>
              <tr><th>Min</th><td id="mMin">-</td></tr>
              <tr><th>Q1</th><td id="mQ1">-</td></tr>
              <tr><th>Q3</th><td id="mQ3">-</td></tr>
              <tr><th>Median</th><td id="mMedian">-</td></tr>
              <tr><th>Max</th><td id="mMax">-</td></tr>
              <tr><th>Std</th><td id="mStd">-</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Compare Modal -->
  <div class="modal fade" id="compareModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="compareTitle">Bandingkan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Jenis Perbandingan</label>
            <select id="cmpMode" class="form-select"></select>
          </div>
          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">Periode A</label>
              <select id="cmpYearA" class="form-select"></select>
            </div>
            <div class="col-6">
              <label class="form-label">Periode B</label>
              <select id="cmpYearB" class="form-select"></select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="cmpApply">Terapkan</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    const months = @json($months);
    const incomeData = @json($incomeData);
    const expenseData = @json($expenseData);

    const rupiah = (n)=> new Intl.NumberFormat('id-ID', { style:'currency', currency:'IDR', minimumFractionDigits:0 }).format(n);
    const abbrev = (v)=> {
      const av = Math.abs(v);
      if (av >= 1_000_000) return Math.round(v/1_000_000) + 'M';
      if (av >= 1_000) return Math.round(v/1_000) + 'K';
      return String(v);
    };

    const percentileInc = (arr, p)=>{
      const a = [...arr].sort((x,y)=>x-y);
      const n = a.length;
      if (n === 0) return 0;
      const pos = (n - 1) * p + 1;
      const k = Math.floor(pos);
      const d = pos - k;
      if (k <= 1) return a[0];
      if (k >= n) return a[n-1];
      return a[k-1] + d * (a[k] - a[k-1]);
    };

    const computeMetrics = (monthly)=>{
      const n = monthly.length;
      const sum = monthly.reduce((acc,v)=>acc+v,0);
      const mean = sum / n;
      const sorted = [...monthly].sort((a,b)=>a-b);
      const min = sorted[0] ?? 0;
      const max = sorted[n-1] ?? 0;
      const median = (sorted[5] + sorted[6]) / 2;
      const q1 = percentileInc(monthly, 0.25);
      const q3 = percentileInc(monthly, 0.75);
      const variance = monthly.reduce((acc,v)=>acc + Math.pow(v - mean,2),0) / (n - 1);
      const std = Math.sqrt(variance);
      return { sum, mean, min, q1, median, q3, max, std };
    };


    const yearsIncome = Object.keys(incomeData).map(y=>parseInt(y)).sort((a,b)=>a-b);
    const yearsExpense = Object.keys(expenseData).map(y=>parseInt(y)).sort((a,b)=>a-b);

    const incomeYearSel = document.getElementById('incomeYear');
    const expenseYearSel = document.getElementById('expenseYear');
    yearsIncome.forEach(y=>{ const o=document.createElement('option'); o.value=y; o.textContent=`Tahun ${y}`; incomeYearSel.appendChild(o); });
    yearsExpense.forEach(y=>{ const o=document.createElement('option'); o.value=y; o.textContent=`Tahun ${y}`; expenseYearSel.appendChild(o); });
    incomeYearSel.value = yearsIncome[yearsIncome.length-1];
    expenseYearSel.value = yearsExpense[yearsExpense.length-1];

    const baseOptions = (max)=>({
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        x: { ticks:{ color: '#6b7280', font: { weight: 500 } }, grid: { display: false } },
        y: {
          beginAtZero: true,
          suggestedMax: max,
          ticks:{ callback: (v)=>abbrev(v), color: '#6b7280', font: { weight: 500 } },
          grid: { color: 'rgba(79, 70, 229, 0.08)' }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(79, 70, 229, 0.9)',
          padding: 12,
          cornerRadius: 8,
          titleFont: { weight: 600, size: 14 },
          bodyFont: { size: 13, weight: 500 },
          callbacks: { label: (ctx)=> `${ctx.dataset.label}: ${rupiah(ctx.parsed.y)}` }
        }
      }
    });

    const incomeCtx = document.getElementById('incomeChart');
    const expenseCtx = document.getElementById('expenseChart');
    const compareCtx = document.getElementById('compareChart');

    const calcMax = (arr)=>{
      const m = Math.max(...arr);
      const step = 5_000_000;
      return Math.ceil(m / step) * step;
    };

    let incomeChart = new Chart(incomeCtx, {
      type: 'line',
      data: { labels: months, datasets:[{ label:'Pemasukan', data: incomeData[incomeYearSel.value], borderColor: '#0d9488', backgroundColor: 'rgba(13, 148, 136, 0.08)', tension: 0.3, borderWidth: 2.5, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderColor: '#0d9488', pointBorderWidth: 2, fill: true }] },
      options: baseOptions(calcMax(incomeData[incomeYearSel.value]))
    });

    let expenseChart = new Chart(expenseCtx, {
      type: 'line',
      data: { labels: months, datasets:[{ label:'Pengeluaran', data: expenseData[expenseYearSel.value], borderColor: '#ef4444', backgroundColor: 'rgba(239, 68, 68, 0.08)', tension: 0.3, borderWidth: 2.5, pointRadius: 4, pointBackgroundColor: '#fff', pointBorderColor: '#ef4444', pointBorderWidth: 2, fill: true }] },
      options: baseOptions(calcMax(expenseData[expenseYearSel.value]))
    });

    let compareChart = new Chart(compareCtx, {
      type: 'line',
      data: { labels: months, datasets: [] },
      options: baseOptions(5000000)
    });

    const updateIncome = ()=>{
      const arr = incomeData[incomeYearSel.value];
      incomeChart.data.datasets[0].data = arr;
      incomeChart.options.scales.y.suggestedMax = calcMax(arr);
      incomeChart.update();
    };

    const updateExpense = ()=>{
      const arr = expenseData[expenseYearSel.value];
      expenseChart.data.datasets[0].data = arr;
      expenseChart.options.scales.y.suggestedMax = calcMax(arr);
      expenseChart.update();
    };

    incomeYearSel.addEventListener('change', updateIncome);
    expenseYearSel.addEventListener('change', updateExpense);

    const statsModalEl = document.getElementById('statsModal');
    const bsModal = new bootstrap.Modal(statsModalEl);
    const fillStats = (title, monthly)=>{
      const m = computeMetrics(monthly);
      document.getElementById('statsTitle').textContent = title;
      document.getElementById('mSum').textContent = rupiah(m.sum);
      document.getElementById('mMean').textContent = rupiah(Math.round(m.mean));
      document.getElementById('mMin').textContent = rupiah(m.min);
      document.getElementById('mQ1').textContent = rupiah(Math.round(m.q1));
      document.getElementById('mQ3').textContent = rupiah(Math.round(m.q3));
      document.getElementById('mMedian').textContent = rupiah(Math.round(m.median));
      document.getElementById('mMax').textContent = rupiah(m.max);
      document.getElementById('mStd').textContent = rupiah(Math.round(m.std));
    };

    document.getElementById('incomeStatsBtn').addEventListener('click', ()=>{
      const y = incomeYearSel.value;
      fillStats(`Pemasukan Tahun ${y}`, incomeData[y]);
      bsModal.show();
    });

    document.getElementById('expenseStatsBtn').addEventListener('click', ()=>{
      const y = expenseYearSel.value;
      fillStats(`Pengeluaran Tahun ${y}`, expenseData[y]);
      bsModal.show();
    });

    let currentCompareTarget = 'income';
    const compareModalEl = document.getElementById('compareModal');
    const compareModal = new bootstrap.Modal(compareModalEl);
    const cmpModeSel = document.getElementById('cmpMode');
    const cmpYearASel = document.getElementById('cmpYearA');
    const cmpYearBSel = document.getElementById('cmpYearB');
    const cmpTitleEl = document.getElementById('compareTitle');
    const cmpApplyBtn = document.getElementById('cmpApply');

    const setOptions = (sel, years)=>{ sel.innerHTML=''; years.forEach(y=>{ const o=document.createElement('option'); o.value=y; o.textContent=`Tahun ${y}`; sel.appendChild(o); }); };
    const setModes = (target)=>{
      cmpModeSel.innerHTML='';
      if (target==='income') {
        cmpModeSel.appendChild(new Option('Pemasukan vs Pemasukan','income_vs_income'));
        cmpModeSel.appendChild(new Option('Pemasukan vs Pengeluaran','income_vs_expense'));
      } else {
        cmpModeSel.appendChild(new Option('Pengeluaran vs Pengeluaran','expense_vs_expense'));
        cmpModeSel.appendChild(new Option('Pengeluaran vs Pemasukan','expense_vs_income'));
      }
    };

    const openCompare = (target)=>{
      currentCompareTarget = target;
      cmpTitleEl.textContent = target==='income' ? 'Bandingkan Pemasukan' : 'Bandingkan Pengeluaran';
      setModes(target);
      setOptions(cmpYearASel, target==='income' ? yearsIncome : yearsExpense);
      setOptions(cmpYearBSel, [...new Set([...yearsIncome, ...yearsExpense])]);
      if (target==='income') { cmpYearASel.value = incomeYearSel.value; }
      else { cmpYearASel.value = expenseYearSel.value; }
      cmpYearBSel.value = cmpYearBSel.options[cmpYearBSel.options.length-1].value;
      compareModal.show();
    };

    const incCmpBtn = document.getElementById('incomeCompareBtn');
    if (incCmpBtn) incCmpBtn.addEventListener('click', ()=>openCompare('income'));
    const expCmpBtn = document.getElementById('expenseCompareBtn');
    if (expCmpBtn) expCmpBtn.addEventListener('click', ()=>openCompare('expense'));

    const applyCompare = ()=>{
      const mode = cmpModeSel.value;
      const yearA = parseInt(cmpYearASel.value,10);
      const yearB = parseInt(cmpYearBSel.value,10);
      const arrA = currentCompareTarget==='income' ? (incomeData[yearA]||Array(12).fill(0)) : (expenseData[yearA]||Array(12).fill(0));
      let arrB, labelA, labelB, colorA, colorB, bgA, bgB;
      if (currentCompareTarget==='income') {
        labelA = `Pemasukan ${yearA}`; colorA = '#0d9488'; bgA = 'rgba(13,148,136,0.12)';
        if (mode==='income_vs_income') { labelB = `Pemasukan ${yearB}`; colorB = '#14b8a6'; bgB = 'rgba(20,184,166,0.12)'; arrB = incomeData[yearB]||Array(12).fill(0); }
        else { labelB = `Pengeluaran ${yearB}`; colorB = '#ef4444'; bgB = 'rgba(239,68,68,0.12)'; arrB = expenseData[yearB]||Array(12).fill(0); }
      } else {
        labelA = `Pengeluaran ${yearA}`; colorA = '#ef4444'; bgA = 'rgba(239,68,68,0.12)';
        if (mode==='expense_vs_expense') { labelB = `Pengeluaran ${yearB}`; colorB = '#14b8a6'; bgB = 'rgba(20,184,166,0.12)'; arrB = expenseData[yearB]||Array(12).fill(0); }
        else { labelB = `Pemasukan ${yearB}`; colorB = '#0d9488'; bgB = 'rgba(13,148,136,0.12)'; arrB = incomeData[yearB]||Array(12).fill(0); }
      }

      const maxCombined = calcMax([...(arrA||[]), ...(arrB||[])]);
      compareChart.data.datasets = [
        { label: labelA, data: arrA, borderColor: colorA, backgroundColor: bgA, tension:0.3, borderWidth:2.5, pointRadius:4, pointBackgroundColor:'#fff', pointBorderColor: colorA, pointBorderWidth:2, fill:true },
        { label: labelB, data: arrB, borderColor: colorB, backgroundColor: bgB, tension:0.3, borderWidth:2.5, pointRadius:4, pointBackgroundColor:'#fff', pointBorderColor: colorB, pointBorderWidth:2, fill:true }
      ];
      compareChart.options = baseOptions(maxCombined);
      compareChart.update();
      compareModal.hide();
    };

    document.getElementById('cmpApply').addEventListener('click', applyCompare);
    const compareOpenBtn = document.getElementById('compareOpenBtn');
    if (compareOpenBtn) compareOpenBtn.addEventListener('click', ()=>openCompare('income'));
  </script>
</body>
</html>
