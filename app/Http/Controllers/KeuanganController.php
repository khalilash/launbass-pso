<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    protected function detectColumn(string $table, array $candidates, string $fallback = null)
    {
        foreach ($candidates as $c) {
            if (Schema::hasColumn($table, $c)) {
                return $c;
            }
        }

        try {
            $cols = collect(DB::select("SHOW COLUMNS FROM {$table}"))->pluck('Field')->map(function($c){
                return $c;
            })->all();
        } catch (\Throwable $e) {
            $cols = [];
        }

        if (!empty($cols)) {
            foreach ($candidates as $cand) {
                if (in_array($cand, $cols, true)) {
                    return $cand;
                }
            }

            if ($fallback !== null && in_array($fallback, $cols, true)) {
                return $fallback;
            }

            return $cols[0];
        }

        return $fallback;
    }

    protected function detectColumnOptional(string $table, array $candidates)
    {
        foreach ($candidates as $c) {
            if (Schema::hasColumn($table, $c)) {
                return $c;
            }
        }

        try {
            $cols = collect(DB::select("SHOW COLUMNS FROM {$table}"))->pluck('Field')->all();
        } catch (\Throwable $e) {
            $cols = [];
        }

        foreach ($candidates as $cand) {
            if (in_array($cand, $cols, true)) {
                return $cand;
            }
        }

        return null;
    }

    protected function monthLabels(): array
    {
        return ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    }

    protected function makeMonthLabel(int $m, int $y): string
    {
        $names = $this->monthLabels();
        $idx = max(1, min(12, $m)) - 1;
        return $names[$idx] . ' ' . $y;
    }

    public function index()
    {
        $inAmt = $this->detectColumn('pemasukan', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $inDate = $this->detectColumn('pemasukan', ['Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Transaksi');

        $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $exDate = $this->detectColumn('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Pengeluaran');

        $inDateCol = $inDate ?: 'created_at';
        $incomeRows = DB::table('pemasukan')
            ->selectRaw("{$inDateCol} as tanggal, {$inAmt} as jumlah, 'pemasukan' as tipe")
            ->orderByDesc($inDateCol)
            ->limit(30);

        $exDateCol = $exDate ?: 'created_at';
        $expenseRows = DB::table('pengeluaran')
            ->selectRaw("{$exDateCol} as tanggal, {$exAmt} as jumlah, 'pengeluaran' as tipe")
            ->orderByDesc($exDateCol)
            ->limit(30);

        $history = DB::query()
            ->fromSub($incomeRows->unionAll($expenseRows), 't')
            ->orderBy('tanggal', 'desc')
            ->limit(30)
            ->get();

        return view('keuangan', compact('history'));
    }

    public function grafik()
    {
        $months = $this->monthLabels();

        $inAmt = $this->detectColumn('pemasukan', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $inDate = $this->detectColumn('pemasukan', ['Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Transaksi');

        $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $exDate = $this->detectColumn('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Pengeluaran');

        $incomeAgg = DB::table('pemasukan')
             ->selectRaw("
        YEAR($inDate) as y,
        MONTH($inDate) as m,
        SUM($inAmt) as total
    ")
    ->groupByRaw("YEAR($inDate), MONTH($inDate)")
    ->get();

        $expenseAgg = DB::table('pengeluaran')
           ->selectRaw("
        YEAR($exDate) as y,
        MONTH($exDate) as m,
        SUM($exAmt) as total
    ")
    ->groupByRaw("YEAR($exDate), MONTH($exDate)")
    ->get();

dd($incomeAgg, $expenseAgg);

        $incomeData = [];
        foreach ($incomeAgg as $row) {
            $y = (int)$row->y;
            $m = (int)$row->m;
            if (!isset($incomeData[$y])) $incomeData[$y] = array_fill(0, 12, 0);
            $incomeData[$y][$m-1] = (int)$row->total;
        }

        $expenseData = [];
        foreach ($expenseAgg as $row) {
            $y = (int)$row->y;
            $m = (int)$row->m;
            if (!isset($expenseData[$y])) $expenseData[$y] = array_fill(0, 12, 0);
            $expenseData[$y][$m-1] = (int)$row->total;
        }

        if (empty($incomeData)) {
            $incomeData[(int)date('Y')] = array_fill(0, 12, 0);
        }
        if (empty($expenseData)) {
            $expenseData[(int)date('Y')] = array_fill(0, 12, 0);
        }

        $yearsIncome = array_values(array_map('intval', array_keys($incomeData)));
        sort($yearsIncome);
        $yearsExpense = array_values(array_map('intval', array_keys($expenseData)));
        sort($yearsExpense);

        return view('grafik_keuangan', compact('months','incomeData','expenseData','yearsIncome','yearsExpense'));
    }

    public function aliranKas()
    {
        $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $exDate = $this->detectColumn('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Pengeluaran');
        $exCat = $this->detectColumn('pengeluaran', ['Kategori','kategori','Kategori_Pengeluaran','kategori_pengeluaran','Jenis','jenis','Nama','nama'], 'Kategori');

        $out = DB::table('pengeluaran')
            ->selectRaw("YEAR({$exDate}) as y, MONTH({$exDate}) as m, {$exCat} as kategori, SUM({$exAmt}) as total")
            ->groupBy('y','m','kategori')
            ->orderBy('y')
            ->orderBy('m')
            ->get();

        $inAmt = $this->detectColumn('pemasukan', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $inDate = $this->detectColumn('pemasukan', ['Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Transaksi');

        $in = DB::table('pemasukan')
            ->selectRaw("YEAR({$inDate}) as y, MONTH({$inDate}) as m, SUM({$inAmt}) as total")
            ->groupBy('y','m')
            ->get();

        $years = [];
        foreach ($out as $r) { $years[] = (int)$r->y; }
        foreach ($in as $r) { $years[] = (int)$r->y; }
        if (empty($years)) { $years = [(int)date('Y')]; }
        $minYear = min($years);
        $maxYear = max($years);

        $months = [];
        $expenseDataByMonth = [];
        for ($y = $minYear; $y <= $maxYear; $y++) {
            for ($m = 1; $m <= 12; $m++) {
                $label = $this->makeMonthLabel($m, $y);
                $months[] = $label;
                $expenseDataByMonth[$label] = [
                    'Listrik' => 0,
                    'Detergen' => 0,
                    'Air' => 0,
                    'Sewa' => 0,
                    'income' => 0,
                ];
            }
        }

        foreach ($out as $r) {
            $label = $this->makeMonthLabel((int)$r->m, (int)$r->y);
            $raw = is_null($r->kategori) ? '' : trim((string)$r->kategori);
            $lc = mb_strtolower($raw);
            if ($lc === 'listrik') $cat = 'Listrik';
            elseif ($lc === 'detergen') $cat = 'Detergen';
            elseif ($lc === 'air') $cat = 'Air';
            elseif ($lc === 'sewa tempat' || $lc === 'sewa') $cat = 'Sewa';
            else $cat = $raw;
            $prev = isset($expenseDataByMonth[$label][$cat]) ? (int)$expenseDataByMonth[$label][$cat] : 0;
            $expenseDataByMonth[$label][$cat] = $prev + (int)$r->total;
        }

        foreach ($in as $r) {
            $label = $this->makeMonthLabel((int)$r->m, (int)$r->y);
            $expenseDataByMonth[$label]['income'] = (int)$r->total;
        }

        return view('aliran_kas', compact('months','expenseDataByMonth'));
    }

    public function storeIncome(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'jumlah' => ['required','numeric','min:1'],
            'catatan' => ['nullable','string','max:255'],
            'tanggal' => ['nullable','date'],
        ]);

        $now = $request->filled('tanggal') ? Carbon::parse($request->input('tanggal')) : now();
        $userId = session('user_id');

        $inAmt = $this->detectColumn('pemasukan', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $inDate = $this->detectColumn('pemasukan', ['Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Transaksi');
        $inUser = $this->detectColumnOptional('pemasukan', ['IDUser','id_user','user_id']);
        $inNote = $this->detectColumnOptional('pemasukan', ['Catatan','catatan','Keterangan','keterangan','Deskripsi','deskripsi']);

        $insertIncome = [
            $inAmt => (int)$data['jumlah'],
            $inDate => $now,
        ];
        if ($inUser) { $insertIncome[$inUser] = $userId; }
        if ($inNote && isset($data['catatan'])) { $insertIncome[$inNote] = $data['catatan']; }

        DB::table('pemasukan')->insert($insertIncome);

        $addCost = $request->boolean('tambah_biaya');
        if ($addCost) {
            $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
            $exDate = $this->detectColumn('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Pengeluaran');
            $exUser = $this->detectColumnOptional('pengeluaran', ['IDUser','id_user','user_id']);
            $exCat = $this->detectColumnOptional('pengeluaran', ['Kategori','kategori','Kategori_Pengeluaran','kategori_pengeluaran','Jenis','jenis','Nama','nama']);
            $exNote = $this->detectColumnOptional('pengeluaran', ['Catatan','catatan','Keterangan','keterangan','Deskripsi','deskripsi']);

            $insertExpense = [
                $exAmt => 20000,
                $exDate => $now,
            ];
            if ($exUser) { $insertExpense[$exUser] = $userId; }
            if ($exCat) { $insertExpense[$exCat] = 'Operasional'; }
            if ($exNote) { $insertExpense[$exNote] = 'Biaya per cucian'; }

            DB::table('pengeluaran')->insert($insertExpense);
        }

        return redirect()->route('keuangan')->with('status','Pemasukan ditambahkan. Biaya Rp20.000 tercatat.');
    }

    public function quickAddIncome(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $now = now();
        $userId = session('user_id');

        $inAmt = $this->detectColumn('pemasukan', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $inDate = $this->detectColumn('pemasukan', ['Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Transaksi');
        $inUser = $this->detectColumnOptional('pemasukan', ['IDUser','id_user','user_id']);
        $inNote = $this->detectColumnOptional('pemasukan', ['Catatan','catatan','Keterangan','keterangan','Deskripsi','deskripsi']);

        $insertIncome = [
            $inAmt => 20000,
            $inDate => $now,
        ];
        if ($inUser) { $insertIncome[$inUser] = $userId; }
        if ($inNote) { $insertIncome[$inNote] = 'Pemasukan manual'; }

        DB::table('pemasukan')->insert($insertIncome);

        $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $exDate = $this->detectColumn('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at'], 'Tanggal_Pengeluaran');
        $exUser = $this->detectColumnOptional('pengeluaran', ['IDUser','id_user','user_id']);
        $exCat = $this->detectColumnOptional('pengeluaran', ['Kategori','kategori','Kategori_Pengeluaran','kategori_pengeluaran','Jenis','jenis','Nama','nama']);
        $exNote = $this->detectColumnOptional('pengeluaran', ['Catatan','catatan','Keterangan','keterangan','Deskripsi','deskripsi']);

        $insertExpense = [
            $exAmt => 20000,
            $exDate => $now,
        ];
        if ($exUser) { $insertExpense[$exUser] = $userId; }
        if ($exCat) { $insertExpense[$exCat] = 'Operasional'; }
        if ($exNote) { $insertExpense[$exNote] = 'Biaya per cucian'; }

        DB::table('pengeluaran')->insert($insertExpense);

        return redirect()->route('keuangan')->with('status','Pemasukan & biaya Rp20.000 ditambahkan.');
    }

    public function storeExpense(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'jumlah' => ['required','numeric','min:1'],
            'kategori' => ['required', Rule::in(['Listrik','Detergen','Air','Sewa Tempat'])],
            'catatan' => ['nullable','string','max:255'],
            'tanggal' => ['nullable','date'],
        ]);

        $now = $request->filled('tanggal') ? Carbon::parse($request->input('tanggal')) : now();
        $userId = session('user_id');

        $exAmt = $this->detectColumn('pengeluaran', ['Jumlah','jumlah','nominal','nilai'], 'Jumlah');
        $exDate = $this->detectColumnOptional('pengeluaran', ['Tanggal_Pengeluaran','tanggal_pengeluaran','Tanggal_Transaksi','tanggal_transaksi','Tanggal','created_at']);
        $exUser = $this->detectColumnOptional('pengeluaran', ['IDUser','id_user','user_id']);
        $exCat = $this->detectColumnOptional('pengeluaran', ['Kategori','kategori','Kategori_Pengeluaran','kategori_pengeluaran','Jenis','jenis','Nama','nama']);
        $exNote = $this->detectColumnOptional('pengeluaran', ['Catatan','catatan','Keterangan','keterangan','Deskripsi','deskripsi']);

        $insertExpense = [
            $exAmt => (int)$data['jumlah'],
        ];
        if ($exDate) { $insertExpense[$exDate] = $now; }
        if ($exUser) { $insertExpense[$exUser] = $userId; }
        if ($exCat) {
            $cat = $data['kategori'];
            if ($cat === 'Sewa Tempat') { $cat = 'Sewa'; }
            $insertExpense[$exCat] = $cat;
        }
        if ($exNote && isset($data['catatan'])) { $insertExpense[$exNote] = $data['catatan']; }

        DB::table('pengeluaran')->insert($insertExpense);

        return redirect()->route('keuangan')->with('status','Pengeluaran ditambahkan.');
    }
}
