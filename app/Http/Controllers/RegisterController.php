<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Name' => 'required',
            'Email' => 'required|email|unique:user,Email',
            'Password' => 'required|min:6'
        ]);

        // Insert ke tabel user
        $id = DB::table('user')->insertGetId([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password)
        ]);

        // Simpan session langsung login
        session([
            'user_id' => $id,
            'user_email' => $request->Email,
            'user_name' => $request->Name
        ]);

        // Redirect ke home
        return redirect('/home');
    }
}
