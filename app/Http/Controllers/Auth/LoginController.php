<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Setelah login, redirect ke dashboard sesuai role.
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Cek role user
        switch ($user->role) {
            case 1:
                return '/dashboard/siswa'; // Kalau siswa
            case 2:
                return '/dashboard/guru';  // Kalau guru
            case 3:
                return '/dashboard/admin'; // Kalau admin
            default:
                return '/home'; // Kalau role tidak dikenali
        }
    }

    /**
     * Ganti login pakai kolom 'name' (bukan 'email').
     */
    public function username()
    {
        return 'name';
    }

    /**
     * Buat konstruktor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
