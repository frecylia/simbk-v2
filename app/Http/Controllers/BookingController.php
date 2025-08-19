<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan daftar jadwal yang masih tersedia
    public function index()
    {
        $availabilities = Schedule::with('teacher')
            ->where('is_booked', false)
            ->orderBy('schedule_date')
            ->orderBy('schedule_time')
            ->get();

        return view('bookings.index', compact('availabilities'));
    }

    // Proses booking oleh siswa
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);

        if ($schedule->is_booked) {
            return back()->with('error', 'Jadwal ini sudah dibooking.');
        }

        // Simpan ke tabel bookings
        Booking::create([
            'student_id' => Auth::id(),  // pastikan siswa login
            'teacher_id' => $schedule->teacher_id,
            'schedule_date' => $schedule->schedule_date,
            'schedule_time' => $schedule->schedule_time,
        ]);

        // Update jadwal jadi booked
        $schedule->update(['is_booked' => true]);

        return back()->with('success', 'Booking berhasil!');
    }
}
