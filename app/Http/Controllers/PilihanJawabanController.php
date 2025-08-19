<?php

namespace App\Http\Controllers;

use App\Models\PilihanJawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PilihanJawabanController extends Controller
{
    public function index()
    {
        $pilihanJawaban = PilihanJawaban::with('soal')->get();
        return view('master.pilihan-jawaban.index', compact('pilihanJawaban'));
    }

    public function create()
    {
        $soal = Soal::all();
        return view('master.pilihan-jawaban.create', compact('soal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'soal_id' => 'required|exists:soals,id',
            'teks_pilihan' => 'required|string',
            'nilai' => 'required|numeric',
             'is_benar' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            PilihanJawaban::create([
                'soal_id' => $request->soal_id,
                'teks_pilihan' => $request->teks_pilihan,
                'nilai' => $request->nilai,
                'is_benar' => $request->nilai,
            ]);

            DB::commit();
            return redirect()->route('pilihan-jawaban.index')
                ->with('success', 'Pilihan jawaban berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal menyimpan pilihan jawaban: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $pilihanJawaban = PilihanJawaban::findOrFail($id);
        $soal = Soal::all();
        return view('master.pilihan-jawaban.edit', compact('pilihanJawaban', 'soal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'soal_id' => 'required|exists:soals,id',
            'teks_pilihan' => 'required|string',
            'nilai' => 'required|numeric',
            'is_benar' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $pilihanJawaban = PilihanJawaban::findOrFail($id);
            
            $pilihanJawaban->update([
                'soal_id' => $request->soal_id,
                'teks_pilihan' => $request->teks_pilihan,
                'nilai' => $request->nilai,
                'is_benar' => $request->has('is_benar') ? true : false,
            ]);

            DB::commit();
            return redirect()->route('pilihan-jawaban.index')
                ->with('success', 'Pilihan jawaban berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Gagal memperbarui pilihan jawaban: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $pilihanJawaban = PilihanJawaban::findOrFail($id);
            $pilihanJawaban->delete();
            
            return redirect()->route('pilihan-jawaban.index')
                ->with('success', 'Pilihan jawaban berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menghapus pilihan jawaban: ' . $e->getMessage()]);
        }
    }
}