<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class ForgotPasswordController extends Controller
{
    // Step 1: Show email input form
    public function showEmailForm()
    {
        return view('forgot-password-email');
    }

    // Step 2: Send verification code to email
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Check if user exists (sesuaikan nama kolom jika berbeda)
        $user = User::where('Email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem.']);
        }

        // Generate 4-digit code
        $code = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Delete old codes for this email
        DB::table('Password_Reset_Codes')
            ->where('Email', $email)
            ->delete();

        // Store new code (expires in 10 minutes)
        DB::table('Password_Reset_Codes')->insert([
            'Email' => $email,
            'Code' => $code,
            'Created_At' => now(),
            'Expires_At' => now()->addMinutes(10),
            'Used' => 0
        ]);

        try {
            // For production: send email (commented out here)
            /*
            Mail::send('emails.reset-code', ['code' => $code, 'nama' => $user->Nama], function($message) use ($email) {
                $message->to($email);
                $message->subject('Kode Verifikasi Reset Password - Launbass App');
            });
            */

            // Development: store in session & log
            session(['reset_code_for_testing' => $code]);
            Log::info("Reset code untuk {$email}: {$code}");

            // Store email in session for next step
            session(['reset_email' => $email]);

            return redirect()->route('password.verify')->with('success', 'Kode verifikasi telah dikirim ke email Anda!');
        } catch (\Exception $e) {
            Log::error('Email error: ' . $e->getMessage());

            // Fallback: store in session for testing
            session(['reset_code_for_testing' => $code]);
            session(['reset_email' => $email]);

            return redirect()->route('password.verify')
                ->with('success', 'Kode verifikasi telah dibuat. (Development mode: cek console/log untuk melihat kode)');
        }
    }

    // Step 3: Show verification code form
    public function showVerifyForm()
    {
        if (!session()->has('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('forgot-password-verify');
    }

    // Step 4: Verify the code
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:4'
        ]);

        $email = session('reset_email');
        $code = $request->code;

        // Check code in database
        $resetRecord = DB::table('Password_Reset_Codes')
            ->where('Email', $email)
            ->where('Code', $code)
            ->where('Used', 0)
            ->where('Expires_At', '>', now())
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid atau sudah kadaluarsa.']);
        }

        // Store verified status in session
        session(['reset_code_verified' => true]);
        session()->save(); // Explicit save to ensure session is persisted

        return redirect()->route('password.reset');
    }

    // Step 5: Show reset password form
    public function showResetForm()
    {
        // Hanya izinkan akses kalau kode sudah diverifikasi ATAU jika ini adalah redirect setelah password berhasil diubah
        if (!session()->has('reset_code_verified') && !session()->has('password_changed')) {
            return redirect()->route('password.request')->withErrors(['error' => 'Silakan verifikasi kode terlebih dahulu.']);
        }

        return view('forgot-password-reset');
    }

public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:8|confirmed'
    ]);

    $email = session('reset_email');

    if (!$email) {
        return redirect()->route('password.request')
            ->withErrors(['email' => 'Session expired. Please try again.']);
    }

    $user = User::where('Email', $email)->first();

    if (!$user) {
        return redirect()->route('password.request')
            ->withErrors(['email' => 'User tidak ditemukan.']);
    }

    // Update password
    $user->Password = Hash::make($request->password);
    $user->save();

    // Mark code as used
    DB::table('Password_Reset_Codes')
        ->where('Email', $email)
        ->update(['Used' => 1]);

    // Hapus semua session terkait reset flow
    session()->forget(['reset_email', 'reset_code_verified', 'reset_code_for_testing']);

    // Flash password_changed flag untuk di-deteksi di Blade
    return redirect()->route('password.reset')->with('password_changed', true);
}

}
