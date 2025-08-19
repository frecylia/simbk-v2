<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilTes;
use App\Models\KategoriMinat;
use App\Models\Peminatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HasilTesController extends Controller
{
    /**
     * Menampilkan semua hasil tes
     */
    public function index()
    {
        $peminatan = Peminatan::with(['user', 'jawabanSiswa.pilihanJawaban.soal'])->get();
        return view('hasil_tes.index', compact('peminatan'));
    }

    public function show(User $user){
        $peminatan = Peminatan::with(['user', 'jawabanSiswa.pilihanJawaban.soal'])
                              ->where('user_id', $user->id)
                              ->first();

        $kategoriSoal = KategoriMinat::with(['soal.pilihanJawaban'])->get();
        
        $jawabanSiswa = $peminatan->jawabanSiswa->pluck('pilihan_jawaban_id', 'soal_id');

        return view('formulir.hasil', compact('peminatan', 'kategoriSoal', 'jawabanSiswa'));
    }

    /**
     * Menyimpan data hasil tes ke database
     */
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'kelas' => 'required|string|max:50',
            'gender' => 'required',
            'minat' => 'required|array|min:1',
            'bakat' => 'required|array|min:1',
        ]);

        // Ambil data yang diperlukan
        $minat = $request->minat;
        $bakat = $request->bakat;

        // Hitung skor per kategori (sederhana)
        $score = [
            'Teknik' => 0,
            'Kesehatan' => 0,
            'Seni' => 0,
            'Bisnis' => 0,
            'Sosial' => 0,
            'Olahraga' => 0,
            'Literatur' => 0,
            'Bahasa' => 0,
            'Kepemimpinan' => 0,
            'Ilmu Alam' => 0,
        ];

        foreach ($minat as $item) {
            if (str_contains($item, 'elektronik') || str_contains($item, 'komputer')) $score['Teknik']++;
            if (str_contains($item, 'kesehatan')) $score['Kesehatan']++;
            if (str_contains($item, 'seni') || str_contains($item, 'desain') || str_contains($item, 'gambar')) $score['Seni']++;
            if (str_contains($item, 'bisnis')) $score['Bisnis']++;
            if (str_contains($item, 'berbicara') || str_contains($item, 'debat')) $score['Sosial']++;
            if (str_contains($item, 'olahraga')) $score['Olahraga']++;
            if (str_contains($item, 'menulis')) $score['Literatur']++;
            if (str_contains($item, 'logika')) $score['Ilmu Alam']++;
            if (str_contains($item, 'bahasa')) $score['Bahasa']++;
            if (str_contains($item, 'memimpin')) $score['Kepemimpinan']++;
        }

        foreach ($bakat as $index => $nilai) {
            $nilai = (int) $nilai;
            if (in_array($index, [0, 5])) $score['Ilmu Alam'] += $nilai;
            if (in_array($index, [1])) $score['Seni'] += $nilai;
            if (in_array($index, [2])) $score['Bahasa'] += $nilai;
            if (in_array($index, [3])) $score['Seni'] += $nilai;
            if (in_array($index, [4])) $score['Sosial'] += $nilai;
            if (in_array($index, [6])) $score['Literatur'] += $nilai;
            if (in_array($index, [7])) $score['Kepemimpinan'] += $nilai;
            if (in_array($index, [8])) $score['Olahraga'] += $nilai;
            if (in_array($index, [9])) $score['Teknik'] += $nilai;
        }

        // Ambil skor tertinggi
        arsort($score);
        $top = array_key_first($score);

        // Tentukan jurusan S1 berdasarkan skor tertinggi
        $rekomendasi = match ($top) {
            'Teknik' => 'Teknik Informatika, Teknik Mesin, Teknik Elektro',
            'Kesehatan' => 'Kedokteran, Keperawatan, Farmasi',
            'Seni' => 'Desain Komunikasi Visual, Seni Rupa, Arsitektur',
            'Bisnis' => 'Manajemen, Akuntansi, Administrasi Bisnis',
            'Sosial' => 'Ilmu Komunikasi, Hubungan Internasional, Sosiologi',
            'Olahraga' => 'Pendidikan Jasmani, Ilmu Keolahragaan',
            'Literatur' => 'Sastra Indonesia, Sastra Inggris',
            'Bahasa' => 'Pendidikan Bahasa Inggris, Bahasa Asing',
            'Kepemimpinan' => 'Ilmu Politik, Hukum, Administrasi Publik',
            'Ilmu Alam' => 'Fisika, Kimia, Biologi, Matematika',
            default => 'Tidak Diketahui'
        };

        // Simpan ke database
        HasilTes::create([
            'user_id' => Auth::id(),
            'minat' => json_encode($minat),
            'bakat' => json_encode($bakat),
            'rekomendasi_jurusan' => $rekomendasi
        ]);

        return redirect()->route('hasil.index')->with('success', 'Tes berhasil dikirim dan dianalisis.');
    }
}

