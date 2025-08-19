@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="main-content bg-white p-4 rounded shadow-sm">
            <div class="text-center mb-5">
                <h1 class="text-primary">HASIL TES PEMINATAN KEJURUAN</h1>
                <h2 class="text-secondary h3">MAN 1 Bandung</h2>
            </div>
            
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            {{-- DATA PRIBADI --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white"><h2 class="mb-0 h4">DATA PRIBADI</h2></div>
                <div class="card-body">
                    <p><strong>Nama Lengkap:</strong> {{ $peminatan->user->name }}</p>
                    <p><strong>Nomor Induk Siswa:</strong> {{ $peminatan->user->nis }}</p>
                    <p><strong>Email:</strong> {{ $peminatan->user->email }}</p>
                    <p><strong>No. Telepon:</strong> {{ $peminatan->user->no_telp }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($peminatan->user->tanggal_lahir)->format('d F Y') }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $peminatan->user->jenis_kelamin }}</p>
                    <p><strong>Alamat:</strong> {{ $peminatan->user->alamat }}</p>
                </div>
            </div>

            {{-- RIWAYAT & PEMINATAN --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white"><h2 class="mb-0 h4">RIWAYAT PENDIDIKAN & PEMINATAN JURUSAN</h2></div>
                <div class="card-body">
                    <p><strong>Asal SMP:</strong> {{ $peminatan->asal_smp }}</p>
                    <p><strong>Nilai Rata-rata Rapor:</strong> {{ $peminatan->nilai_rapor }}</p>
                    <p><strong>Prestasi:</strong> {{ $peminatan->prestasi ?: '-' }}</p>
                    <hr>
                    <h5 class="mt-3">Pilihan Peringkat Jurusan:</h5>
                    <p><strong>Peringkat 1:</strong> 
                        @if($peminatan->rank_ipa == 1) IPA @elseif($peminatan->rank_ips == 1) IPS @else Bahasa @endif
                    </p>
                    <p><strong>Peringkat 2:</strong> 
                        @if($peminatan->rank_ipa == 2) IPA @elseif($peminatan->rank_ips == 2) IPS @else Bahasa @endif
                    </p>
                    <p><strong>Peringkat 3:</strong> 
                        @if($peminatan->rank_ipa == 3) IPA @elseif($peminatan->rank_ips == 3) IPS @else Bahasa @endif
                    </p>
                </div>
            </div>

            {{-- HASIL TES KEMAMPUAN --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white"><h2 class="mb-0 h4">HASIL TES KEMAMPUAN DASAR</h2></div>
                <div class="card-body">
                    @php($nomor = 1)
                    @foreach ($kategoriSoal as $kategori)
                    <div class="peminatan-section card mb-3">
                        <div class="card-header bg-light"><h3 class="mb-0 h5">{{ $kategori->nama_kategori }}</h3></div>
                        <div class="card-body">
                            @foreach ($kategori->soal as $soal)
                            <div class="question mb-4">
                                <p class="fw-bold">{!! $nomor . '. ' . $soal->pertanyaan !!}</p>
                                @foreach ($soal->pilihanJawaban as $pilihan)
                                    <div class="p-2 rounded 
                                        {{ ($jawabanSiswa[$soal->id] ?? null) == $pilihan->id ? 'bg-success-subtle border border-success' : 'bg-light' }}">
                                        @if(($jawabanSiswa[$soal->id] ?? null) == $pilihan->id)
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                        @else
                                            <i class="fa fa-circle-thin me-2 text-muted" style="margin-left:2px; margin-right:4px;"></i>
                                        @endif
                                        <label>{!! $pilihan->teks_pilihan !!}</label>
                                    </div>
                                @endforeach
                            </div>
                            @php($nomor++)
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection