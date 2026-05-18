<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required'
        ]);

        // Cek user berdasarkan email
        $user = DB::table('user')->where('Email', $request->Email)->first();

        if (!$user) {
            return back()->withErrors(['Email' => 'Email not found'])->withInput();
        }

        // Cek password hash
        if (!Hash::check($request->Password, $user->Password)) {
            return back()->withErrors(['Password' => 'Wrong password'])->withInput();
        }

        // Simpan session
        session([
            'user_id' => $user->UserID,
            'user_email' => $user->Email,
            'user_name' => $user->Name ?? null
        ]);

        // Redirect ke home (sesuai web.php kamu)
        return redirect('/home');
    }
}
