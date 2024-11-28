<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas) {
            // Cek apakah password menggunakan bcrypt
            if (Hash::needsRehash($petugas->password)) {
                // Jika password adalah plain text
                if ($request->password === $petugas->password) {
                    $this->createSession($petugas);
                    return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
                }
            } else {
                // Jika password menggunakan bcrypt
                if (Hash::check($request->password, $petugas->password)) {
                    $this->createSession($petugas);
                    return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
                }
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }

    private function createSession($petugas)
    {
        Session::put('petugas_id', $petugas->id);
        Session::put('username', $petugas->username);
        Session::put('is_logged_in', true);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Berhasil logout');
    }
} 