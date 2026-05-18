<?php

// NRP: 5026231227| Nama: Arjuna Veetaraq
// NRP: 5026231206 | Rafael Dimas Khristianto

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // pakai kolom "Email" (huruf besar), sesuai DB & RegisterController
        $user = User::where('Email', $credentials['email'])->first();

        // kalau user tidak ada atau password beda (gunakan Hash::check untuk hash)
        if (! $user || ! Hash::check($credentials['password'], $user->Password)) {
            return back()
                ->with('error', 'Email atau password salah.')
                ->withInput();
        }

        // set session sama seperti di RegisterController
        session([
            'user_id'   => $user->IDUser,
            'user_name' => $user->Nama,
        ]);

        // redirect ke homepage
        return redirect()->route('home');
    }
}
