<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Menampilkan form login untuk admin
    public function showLoginForm()
    {
        return view('auth.login_admin'); // Gantilah dengan view yang sesuai
    }

    // Menangani proses login admin
    public function login(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email', // Pastikan email valid
            'password' => 'required|string', // Pastikan password ada
        ]);

        // Mengambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Mencoba login menggunakan guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman dashboard admin
            return redirect()->intended('/dashboard-admin');
        }

        // Jika login gagal, kembali dengan error message
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // Proses logout admin
    public function logout(Request $request)
    {
        // Logout dari guard admin
        Auth::guard('admin')->logout();

        // Menghapus session dan regenerasi token CSRF untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login admin
        return redirect()->route('admin.login');
    }
}
