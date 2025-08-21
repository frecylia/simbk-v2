<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('name', 'Admin');
        })->get();  

        $schedules = Schedule::with(['student', 'teacher'])->where('user_id', Auth::user()->id)->get();

        return view('schedule.index', ['users' => $users, 'schedules' => $schedules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => [
                'required',
                'date_format:H:i',
                Rule::unique('schedules')->where(function ($query) use ($request) {
                    return $query->where('schedule_date', $request->schedule_date)
                                 ->where('user_id', $request->user_id);
                }),
            ],
            'user_id' => 'required|integer|exists:users,id',
            'description' => 'nullable|string|max:1000',
        ], [
            'schedule_time.unique' => 'Jadwal pada jam ini dengan guru tersebut sudah dipesan. Silakan pilih jam lain.'
        ]);

        DB::beginTransaction();
        try {
            Schedule::create([
                'schedule_date' => $request->schedule_date,
                'schedule_time' => $request->schedule_time,
                'student_id'    => Auth::id(), // Pastikan user yang login adalah siswa
                'user_id'       => $request->user_id, // ID Guru BK
                'description'   => $request->description, // Sesuaikan dengan nama input di form
                'status'        => 'pending', // Set status awal
            ]);
    
            DB::commit();
    
            return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil dibuat dan sedang menunggu persetujuan.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan jadwal: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat jadwal.')->withInput();
        }
    }

    public function getTeacherAvailability(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $date = Carbon::parse($request->date);
        $dayOfWeek = $date->dayOfWeekIso;

        $availableTeachers = User::whereHas('roles', fn($q) => $q->where('name', 'GuruBK'))
            ->whereHas('availabilities', fn($q) => $q->where('day_of_week', $dayOfWeek))
            ->with('availabilities', fn($q) => $q->where('day_of_week', $dayOfWeek))
            ->get();


        $result = [];
        foreach ($availableTeachers as $teacher) {
            $availability = $teacher->availabilities->first();
            $startTime = Carbon::parse($availability->start_time);
            $endTime = Carbon::parse($availability->end_time);
            
            $bookedTimes = Schedule::where('user_id', $teacher->id)
                ->where('schedule_date', $date->toDateString())
                ->pluck('schedule_time')
                ->map(fn($time) => Carbon::parse($time)->format('H:i'))
                ->toArray();

            $availableSlots = [];
            while ($startTime < $endTime) {
                $slot = $startTime->format('H:i');
                if (!in_array($slot, $bookedTimes)) {
                    $availableSlots[] = $slot;
                }
                $startTime->addMinutes(30);
            }

    
            if (!empty($availableSlots)) {
                $result[] = [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'slots' => $availableSlots
                ];
            }
        }

        return response()->json($result);
    }

    public function getSchedules()
    {
        $schedules = Schedule::with(['student', 'teacher'])->where('student_id', Auth::id())->get();
        $events = $schedules->map(function ($schedule) {
            if (strtolower($schedule->status) == 'disetujui'){
                $status = '<span class="badge bg-success">Disetujui</span>';
            }elseif (strtolower($schedule->status) == 'pending'){
                $status = '<span class="badge bg-warning text-dark">Pending</span>';
            }elseif (strtolower($schedule->status) == 'ditolak'){
                $status = '<span class="badge bg-danger">Tolak</span>';
            }else{
                $status = '<span class="badge bg-secondary">Tidak diketahui</span>';
            }
            return [
                'title' => 'Konseling: ' . $schedule->teacher?->name,
                'start' => $schedule->schedule_date,
                'extendedProps' => [
                    'siswa' => $schedule->student?->name,
                    'guru' => $schedule->teacher->name ?? '-',
                    'schedule_time' => $schedule->schedule_time,
                    'deskripsi' => $schedule->description ?? '-',
                    'status' => $status ?? '-'
                ]
            ];
        });

        return response()->json($events);
    }
    
    /**
     * Approve a schedule
     */
    public function approve($id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->status = 'disetujui';
            $schedule->save();
            
            return redirect()->back()->with('success', 'Jadwal berhasil disetujui!');
        } catch (\Exception $e) {
            Log::error('Gagal menyetujui jadwal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyetujui jadwal.');
        }
    }
    
    /**
     * Reject a schedule
     */
    public function reject($id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->status = 'ditolak';
            $schedule->save();
            
            return redirect()->back()->with('success', 'Jadwal berhasil ditolak!');
        } catch (\Exception $e) {
            Log::error('Gagal menolak jadwal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menolak jadwal.');
        }
    }
}

