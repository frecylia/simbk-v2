<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruLoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.guru-login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'nama' => 'required|string',   // Nama harus ada dan string
            'password' => 'required|string', // Password harus ada dan string
        ]);

        // Mengecek kredensial menggunakan Auth::attempt
        // Pastikan 'nama' adalah kolom yang valid di database
        if (Auth::attempt(['nama' => $request->nama, 'password' => $request->password])) {
            // Jika login berhasil, redirect ke dashboard
            return redirect()->intended('/dashboard');
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors(['error' => 'Nama atau password salah.']);
    }

    // Mengatur kolom yang digunakan untuk login (biasanya 'nama' atau 'email')
    public function username()
    {
        return 'nama';  // Gunakan kolom 'nama' untuk login
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Menghasilkan CSRF token baru
        return redirect()->route('guru.login'); // Redirect ke halaman login
    }
}
