<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = User::whereHas('roles', function($q){
            $q->where('name', 'Admin');
        })->get();  
        return view('guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $guru = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nis' => $request->nis,
            ]);
    
            $guru->assignRole('Admin');
    
            DB::commit();
    
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data guru: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = User::find($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {

            $guru = User::find($id);

            if(!$guru){
                return redirect()->back()->withInput()->withErrors(['error' => 'Data Tidak Ada']);

            }

            $guru->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'nis' => $request->nis,
            ]);
          
            $guru->assignRole('Admin');
    
            DB::commit();
    
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data guru: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = User::find($id);
        if(!$guru){
            return redirect()->back()->withInput()->withErrors(['error' => 'Data Tidak Ada']);
        }

        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
