<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\KategoriMinat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
    public function index()
    {
        $soal = Soal::with('kategoriMinat')->get();
        return view('master.soal.index', compact('soal'));
    }

    public function create()
    {
        $kategoriMinat = KategoriMinat::all();
        return view('master.soal.create', compact('kategoriMinat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'kategori_id' => 'required|exists:kategori_minats,id',
        ]);

        DB::beginTransaction();
        try {
            Soal::create([
                'pertanyaan' => $request->pertanyaan,
                'kategori_id' => $request->kategori_id,
            ]);

            DB::commit();
            return redirect()->route('soal.index')
                ->with('success', 'Soal berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal menyimpan soal: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        $kategoriMinat = KategoriMinat::all();
        return view('master.soal.edit', compact('soal', 'kategoriMinat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'kategori_id' => 'required|exists:kategori_minats,id',
        ]);

        DB::beginTransaction();
        try {
            $soal = Soal::findOrFail($id);
            
            $soal->update([
                'pertanyaan' => $request->pertanyaan,
                'kategori_id' => $request->kategori_id,
            ]);

            DB::commit();
            return redirect()->route('soal.index')
                ->with('success', 'Soal berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal memperbarui soal: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $soal = Soal::findOrFail($id);
            $soal->delete();
            
            return redirect()->route('soal.index')
                ->with('success', 'Soal berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus soal: ' . $e->getMessage()]);
        }
    }
}