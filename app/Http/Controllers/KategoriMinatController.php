<?php

namespace App\Http\Controllers;

use App\Models\KategoriMinat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KategoriMinatController extends Controller
{
    public function index()
    {
        $kategoriMinat = KategoriMinat::all();
        return view('master.kategori-minat.index', compact('kategoriMinat'));
    }

    public function create()
    {
        return view('master.kategori-minat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            KategoriMinat::create([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            DB::commit();
            return redirect()->route('kategori-minat.index')
                ->with('success', 'Kategori minat berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal menyimpan kategori minat: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $kategoriMinat = KategoriMinat::findOrFail($id);
        return view('master.kategori-minat.edit', compact('kategoriMinat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $kategoriMinat = KategoriMinat::findOrFail($id);
            
            $kategoriMinat->update([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            DB::commit();
            return redirect()->route('kategori-minat.index')
                ->with('success', 'Kategori minat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal memperbarui kategori minat: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $kategoriMinat = KategoriMinat::findOrFail($id);
            $kategoriMinat->delete();
            
            return redirect()->route('kategori-minat.index')
                ->with('success', 'Kategori minat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus kategori minat: ' . $e->getMessage()]);
        }
    }
}