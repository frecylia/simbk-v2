<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class SiswaController extends Controller
{
    public function create()
    {
        return view('siswa.create'); // Pastikan file Blade ini ada di resources/views/siswa/create.blade.php
    }

    public function index()
    {
        $siswa = User::whereHas('roles', function($q){
            $q->where('name', 'Siswa');
        })->get();  
        return view('siswa.index', compact('siswa'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $siswa = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
            ]);
    
            $siswa->assignRole('Siswa');
    
            DB::commit();
    
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data siswa: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $siswa = User::find($id);
        return view('siswa.edit', compact('siswa')); // Pastikan file Blade ini ada di resources/views/siswa/create.blade.php
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $siswa = User::find($id);
            
            if(!$siswa){
                return redirect()->back()->withInput()->withErrors(['error' => 'Data Tidak Ada']);
            }

            $siswa->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'nis' => $request->nis,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
            ]);
    
            DB::commit();
    
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with(['error' => 'Gagal menyimpan data siswa: ' . $e->getMessage()]);
        }
    }

    public function destroy($id){
        $siswa = User::find($id);
        if(!$siswa){
            return redirect()->back()->withInput()->withErrors(['error' => 'Data Tidak Ada']);
        }

        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');

    }

}
