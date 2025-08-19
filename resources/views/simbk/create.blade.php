@extends('layouts.app')

@section('title', 'Input Data SIMBK')

@section('content')
<div class="container">
    <h2 class="mb-4">Form Tambah Data Bimbingan Konseling</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('simbk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Topik Konseling</label>
            <input type="text" name="topik_konseling" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Guru BK</label>
            <input type="text" name="guru_bk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status (Opsional)</label>
            <input type="text" name="status" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('simbk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
