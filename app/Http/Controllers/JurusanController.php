<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\KategoriMinat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::with('kategoriMinat')->get();
        return view('master.jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        $kategoriMinat = KategoriMinat::all();
        return view('master.jurusan.create', compact('kategoriMinat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_dominan_id' => 'required|exists:kategori_minats,id',
        ]);

        DB::beginTransaction();
        try {
            Jurusan::create([
                'nama_jurusan' => $request->nama_jurusan,
                'deskripsi' => $request->deskripsi,
                'kategori_dominan_id' => $request->kategori_dominan_id,
            ]);

            DB::commit();
            return redirect()->route('jurusan.index')
                ->with('success', 'Jurusan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal menyimpan jurusan: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $kategoriMinat = KategoriMinat::all();
        return view('master.jurusan.edit', compact('jurusan', 'kategoriMinat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_dominan_id' => 'required|exists:kategori_minats,id',
        ]);

        DB::beginTransaction();
        try {
            $jurusan = Jurusan::findOrFail($id);
            
            $jurusan->update([
                'nama_jurusan' => $request->nama_jurusan,
                'deskripsi' => $request->deskripsi,
                'kategori_dominan_id' => $request->kategori_dominan_id,
            ]);

            DB::commit();
            return redirect()->route('jurusan.index')
                ->with('success', 'Jurusan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal memperbarui jurusan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $jurusan = Jurusan::findOrFail($id);
            $jurusan->delete();
            
            return redirect()->route('jurusan.index')
                ->with('success', 'Jurusan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus jurusan: ' . $e->getMessage()]);
        }
    }
}