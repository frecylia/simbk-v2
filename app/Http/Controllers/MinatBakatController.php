<?php

namespace App\Http\Controllers;

use App\Models\JawabanSiswa;
use App\Models\KategoriMinat;
use App\Models\Peminatan;
use App\Models\PilihanJawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MinatBakatController extends Controller
{
    public function create()
    {
         $user = Auth::user();
         $peminatan = Peminatan::with(['user', 'jawabanSiswa.pilihanJawaban.soal'])
                              ->where('user_id', $user->id)
                              ->first();

        if ($peminatan) {
            $kategoriSoal = KategoriMinat::with(['soal.pilihanJawaban'])->get();
            
            $jawabanSiswa = $peminatan->jawabanSiswa->pluck('pilihan_jawaban_id', 'soal_id');

            return view('formulir.hasil', compact('peminatan', 'kategoriSoal', 'jawabanSiswa'));
        } else {
            // JIKA BELUM ADA DATA: Tampilkan formulir kosong
           $kategoriSoal = KategoriMinat::with(['soal.pilihanJawaban'])->get();
        return view('formulir.index', compact('kategoriSoal'));
        }
        

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nis' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'asal_smp' => 'required|string|max:255',
            'nilai_rapor' => 'required|numeric|min:0|max:100',
            'prestasi' => 'nullable|string',
            'rank_ipa' => 'required|integer|in:1,2,3',
            'rank_ips' => 'required|integer|in:1,2,3|different:rank_ipa',
            'rank_bahasa' => 'required|integer|in:1,2,3|different:rank_ipa|different:rank_ips',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|integer|exists:pilihan_jawabans,id',
        ]);
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
            ]);

            $peminatan = Peminatan::create([
                'user_id' => $user->id,
                'asal_smp' => $request->asal_smp,
                'nilai_rapor' => $request->nilai_rapor,
                'prestasi' => $request->prestasi,
                'rank_ipa' => $request->rank_ipa,
                'rank_ips' => $request->rank_ips,
                'rank_bahasa' => $request->rank_bahasa,
            ]);

            $jawabanDgnNilai = PilihanJawaban::whereIn('id', array_values($request->jawaban))->pluck('nilai', 'id');
        
            foreach ($request->jawaban as $soal_id => $pilihan_id) {
                JawabanSiswa::create([
                    'peminatan_id' => $peminatan->id,
                    'soal_id' => $soal_id,
                    'pilihan_jawaban_id' => $pilihan_id,
                    'nilai' => $jawabanDgnNilai[$pilihan_id] ?? 0,
                ]);
            }
            DB::commit();
            return back()->with('success', 'Formulir peminatan Anda berhasil dikirim!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Formulir gagal dikirim, Error: ' . $th->getMessage());
        }
      
      
    }

     public function form()
    {
        // Soal minat RIASEC
        $minat = [
            ['no' => 1, 'pertanyaan' => 'Saya suka menganalisis data dan menyelesaikan persoalan logis.'],
            ['no' => 2, 'pertanyaan' => 'Saya senang membantu teman yang kesulitan belajar.'],
            ['no' => 3, 'pertanyaan' => 'Saya suka membuat desain atau menggambar bebas.'],
            ['no' => 4, 'pertanyaan' => 'Saya tertarik mengelola uang dan membuat rencana keuangan.'],
            ['no' => 5, 'pertanyaan' => 'Saya lebih suka bekerja di luar ruangan daripada di kantor.'],
            ['no' => 6, 'pertanyaan' => 'Saya suka memimpin dan mengambil keputusan untuk kelompok.'],
            ['no' => 7, 'pertanyaan' => 'Saya senang meneliti topik sains dan melakukan eksperimen.'],
            ['no' => 8, 'pertanyaan' => 'Saya menikmati membuat tulisan, cerita, atau puisi.'],
            ['no' => 9, 'pertanyaan' => 'Saya suka berbicara di depan umum dan menyampaikan ide.'],
            ['no' => 10, 'pertanyaan' => 'Saya tertarik bekerja di laboratorium atau ruang eksperimen.'],
            ['no' => 11, 'pertanyaan' => 'Saya suka bekerja dengan data atau angka.'],
            ['no' => 12, 'pertanyaan' => 'Saya senang mempelajari struktur tumbuhan dan hewan.'],
            ['no' => 13, 'pertanyaan' => 'Saya senang berinteraksi dan membimbing teman.'],
            ['no' => 14, 'pertanyaan' => 'Saya tertarik mengembangkan aplikasi atau teknologi baru.'],
            ['no' => 15, 'pertanyaan' => 'Saya suka memecahkan teka-teki dan soal logika.'],
            ['no' => 16, 'pertanyaan' => 'Saya menikmati menghias atau merancang ruang.'],
            ['no' => 17, 'pertanyaan' => 'Saya senang melayani dan memberi dukungan kepada orang lain.'],
            ['no' => 18, 'pertanyaan' => 'Saya tertarik dalam dunia bisnis dan pemasaran.'],
            ['no' => 19, 'pertanyaan' => 'Saya suka bekerja dengan mesin atau alat-alat teknis.'],
            ['no' => 20, 'pertanyaan' => 'Saya senang membuat jadwal atau daftar tugas yang rapi.'],
            ['no' => 21, 'pertanyaan' => 'Saya tertarik membaca buku-buku sains atau teknologi.'],
            ['no' => 22, 'pertanyaan' => 'Saya menikmati pekerjaan yang mengandalkan kreativitas.'],
            ['no' => 23, 'pertanyaan' => 'Saya senang memberikan nasihat atau bimbingan.'],
            ['no' => 24, 'pertanyaan' => 'Saya suka menjadi pemimpin dalam organisasi.'],
            ['no' => 25, 'pertanyaan' => 'Saya menikmati membuat laporan atau grafik.'],
            ['no' => 26, 'pertanyaan' => 'Saya suka mengeksplorasi alam dan lingkungan sekitar.'],
            ['no' => 27, 'pertanyaan' => 'Saya senang menggambar karakter atau ilustrasi.'],
            ['no' => 28, 'pertanyaan' => 'Saya suka mengajar dan berbagi ilmu.'],
            ['no' => 29, 'pertanyaan' => 'Saya suka membangun atau memperbaiki barang rusak.'],
            ['no' => 30, 'pertanyaan' => 'Saya senang merancang produk dan tampilannya.'],
        ];

        // Soal bakat logika, numerik, verbal
        $bakat = [
            ['no' => 31, 'pertanyaan' => 'Berapa hasil dari 5 x (3 + 2)?', 'options' => ['10', '15', '20', '25', '30']],
            ['no' => 32, 'pertanyaan' => "Apa sinonim dari kata 'aktif'?", 'options' => ['Pasif', 'Lesu', 'Dinamis', 'Lambat', 'Tenang']],
            ['no' => 33, 'pertanyaan' => 'Temukan pola berikut: 2, 4, 8, 16, ...', 'options' => ['20', '22', '24', '30', '32']],
            ['no' => 34, 'pertanyaan' => 'Kalimat dengan tanda baca yang benar:', 'options' => [
                'Dia berkata, "Saya akan pergi."',
                'Dia berkata "saya akan pergi".',
                'Dia berkata saya akan pergi.',
                'Dia berkata: "Saya akan pergi"',
                'Dia berkata saya "akan pergi".'
            ]],
            ['no' => 35, 'pertanyaan' => 'Jika semua burung bisa terbang, dan elang adalah burung, maka ...', 'options' => [
                'Elang bisa terbang', 'Elang tidak bisa terbang', 'Elang bukan burung', 'Tidak tahu', 'Tidak relevan'
            ]],
            // ... Tambahkan soal hingga nomor 60
        ];

        return view('tes.form', compact('minat', 'bakat'));
    }

    public function submit(Request $request)
    {
        $input = $request->except('_token');
        $skor = 0;
        $kunci = [
            31 => 'b', 32 => 'c', 33 => 'e', 34 => 'a', 35 => 'a', // dan seterusnya
        ];

        foreach ($kunci as $no => $jawaban) {
            if (isset($input['q'.$no]) && strtolower($input['q'.$no]) == strtolower($jawaban)) {
                $skor++;
            }
        }

        return view('tes.hasil', compact('skor'));
    }
}

