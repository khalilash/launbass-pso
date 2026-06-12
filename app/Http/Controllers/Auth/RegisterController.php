<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function show()
    {
        return view('register');
    }

    /**
     * Handle POST /register
     * Membuat akun baru berdasarkan input user
     */
    public function store(Request $request)
    {
        // validasi input (samakan dengan reset password: min:8 dan confirmed)
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('user', 'Email'), // kolom "Email" sesuai DB kamu
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // buat user baru dengan password di-hash (konsisten dengan reset password)
        $user = User::create([
            // kolom sesuai database (case-sensitive!)
            'Nama'     => $data['name'],
            'Email'    => $data['email'],
            'Password' => Hash::make($data['password']),
            'Jabatan'  => 'User',            // default role
        ]);

        // set session login
        session([
            'user_id'   => $user->IDUser,  // sesuaikan primary key
            'user_name' => $user->Nama,
        ]);

        // redirect ke homepage
        return redirect()->route('home')->with('success', 'Account created and logged in.');
    }
}
