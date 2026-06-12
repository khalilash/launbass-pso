<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* ============================
   PUBLIC ROUTES
   ============================ */

// Splash screen
Route::view('/splash', 'splash')->name('splash');

// Root redirect
Route::get('/', function () {
    return redirect()->route('splash');
});

// Login
Route::view('/login', 'login')->name('login');
Route::view('/login-proto', 'login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Logout
Route::post('/logout', function () {
    session()->flush();
    return redirect('/login');
})->name('logout');


/* ============================
   PROTECTED ROUTES
   ============================ */

// Homepage (ACTIVE ORDERS ONLY)
Route::get('/home', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(HomepageController::class)->index();
})->name('home');

// Riwayat Pesanan (STATUS = "Selesai")
Route::get('/riwayat-pesanan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(HomepageController::class)->history();
})->name('pesanan.riwayat');

// Legacy alias
Route::get('/home-old', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(HomepageController::class)->index();
});

// Main lama
Route::get('/main', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return view('main');
})->name('main');


/* ============================
   KEUANGAN
   ============================ */

Route::get('/keuangan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->index();
})->name('keuangan');

Route::post('/keuangan/pemasukan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->storeIncome();
})->name('keuangan.pemasukan.store');

Route::post('/keuangan/pemasukan/quick', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->quickAddIncome();
})->name('keuangan.pemasukan.quick');

Route::post('/keuangan/pengeluaran', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->storeExpense();
})->name('keuangan.pengeluaran.store');

Route::get('/grafik-keuangan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->grafik();
})->name('grafik.keuangan');

Route::get('/aliran-kas', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(KeuanganController::class)->aliranKas();
})->name('aliran.kas');


/* ============================
   PELANGGAN
   ============================ */

Route::get('/datapelanggan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->index();
})->name('datapelanggan');

Route::get('/pelanggan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->index();
})->name('pelanggan.index');

Route::post('/pelanggan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->store(request());
})->name('pelanggan.store');

Route::get('/pelanggan/{id}/edit', function ($id) {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->edit($id);
})->name('pelanggan.edit');

Route::put('/pelanggan/{id}', function ($id) {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->update(request(), $id);
})->name('pelanggan.update');

Route::patch('/pelanggan/{id}/toggle-status', function ($id) {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PelangganController::class)->toggleStatus($id);
})->name('pelanggan.toggleStatus');


/* ============================
   PESANAN
   ============================ */

// Tambah pesanan
Route::get('/tambahpesanan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PesananController::class)->create();
})->name('tambahpesanan');

// Simpan pesanan
Route::post('/pesanan', function () {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PesananController::class)->store(request());
})->name('pesanan.store');

// Detail pesanan
Route::get('/pesanan/{id}/detail', function ($id) {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(PesananController::class)->show($id);
})->name('pesanan.detail');

// MARK AS SELESAI
Route::patch('/pesanan/{id}/selesai', function ($id) {
    if (!session()->has('user_id'))
        return redirect('/login');
    return app(HomepageController::class)->markAsFinished($id);
})->name('pesanan.selesai');


// ============================
// RIWAYAT PESANAN
// ============================

Route::get('/riwayat-pesanan', function (\Illuminate\Http\Request $request) {
    if (!session()->has('user_id'))
        return redirect('/login');

    $controller = app()->make(HomepageController::class);
    return app()->call([$controller, 'history'], ['request' => $request]);
})->name('pesanan.riwayat');


// ============================
// RESTORE PESANAN (UNDO SELESAI)
// ============================
Route::patch('/pesanan/{id}/restore', function ($id) {
    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    return app(HomepageController::class)->restore($id);
})->name('pesanan.restore');


/* ============================
   PEMBAYARAN
   ============================ */

Route::get('/pembayaran/{id}/cash', [PembayaranController::class, 'cashForm'])
    ->name('pembayaran.cash.form');

Route::post('/pembayaran/{id}/cash', [PembayaranController::class, 'processCash'])
    ->name('pembayaran.cash.process');

Route::get('/pembayaran/{id}/qris', [PembayaranController::class, 'qrisForm'])
    ->name('pembayaran.qris.form');

Route::post('/pembayaran/{id}/qris', [PembayaranController::class, 'processQris'])
    ->name('pembayaran.qris.process');

Route::get('/pembayaran/berhasil/{id}', [PembayaranController::class, 'pembayaranBerhasil'])
    ->name('pembayaran.berhasil');


/* ============================
   FORGOT PASSWORD
   ============================ */

Route::get('/forgot-password', [ForgotPasswordController::class, 'showEmailForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendCode'])
    ->middleware('guest')
    ->name('password.send-code');

Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyForm'])
    ->middleware('guest')
    ->name('password.verify');

Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyCode'])
    ->middleware('guest')
    ->name('password.verify-code');

Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');
