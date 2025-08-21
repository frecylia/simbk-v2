<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\TeacherAvailability;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderByDesc('id')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
            'nis' => 'required',
            'availabilities' => 'nullable|array',
            'availabilities.*.day_of_week' => 'required_with:availabilities|integer|between:1,7',
            'availabilities.*.start_time' => 'required_with:availabilities|date_format:H:i',
            'availabilities.*.end_time' => 'required_with:availabilities|date_format:H:i|after:availabilities.*.start_time',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nis' => $request->nis,
                'role' => $request->role,
                'kelas' => $request->role == 'Siswa' ? $request->kelas : null,
                'jurusan' => $request->role == 'Siswa' ? $request->jurusan : null,
            ]);

            $user->assignRole($request->role);

            if ($request->role == 'GuruBK' && $request->has('availabilities')) {
                foreach ($request->availabilities as $availability) {
                    TeacherAvailability::create([
                        'user_id' => $user->id,
                        'day_of_week' => $availability['day_of_week'],
                        'start_time' => $availability['start_time'],
                        'end_time' => $availability['end_time'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $user = User::with('availabilities')->findOrFail($id);
        $roles = Role::all();
        
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required',
            'nis' => 'required',
            'availabilities' => 'nullable|array',
            'availabilities.*.day_of_week' => 'required_with:availabilities|integer|between:1,7',
            'availabilities.*.start_time' => 'required_with:availabilities',
            'availabilities.*.end_time' => 'required_with:availabilities|after:availabilities.*.start_time',
        ]);

         DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nis' => $request->nis,
                'role' => $request->role,
                'kelas' => $request->role == 'Siswa' ? $request->kelas : null,
                'jurusan' => $request->role == 'Siswa' ? $request->jurusan : null,
            ]);

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
                $user->save();
            }

          
            $user->syncRoles($request->role);

          

            
            if ($request->role == 'GuruBK' && $request->has('availabilities')) {
                $user->availabilities()->delete();
                foreach ($request->availabilities as $availability) {
                    TeacherAvailability::create([
                        'user_id' => $user->id,
                        'day_of_week' => $availability['day_of_week'],
                        'start_time' => $availability['start_time'],
                        'end_time' => $availability['end_time'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
