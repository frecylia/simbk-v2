<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan user sudah login
        $this->middleware('auth');
    }

    public function index()
    {
        $totalSiswa = User::whereHas('roles', function($query) {
            $query->where('name', 'Siswa');
        })->count();

        $totalAllKonseling = 0;
        $totalKonseling = 0;
        if(Auth::user()->hasRole('Admin')){
            $totalAllKonseling = Schedule::where('user_id', Auth::id())->count();
            $totalKonseling = Schedule::whereDate('schedule_date', now()->format('Y-m-d'))->where('user_id', Auth::id())->count();
        }
        // Kirim data ke view
        return view('dashboard.index', compact('totalSiswa','totalAllKonseling','totalKonseling'));
    }

    public function test()
    {
        return view('dashboard.test');
    }
}
