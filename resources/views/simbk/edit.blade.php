@extends('layouts.app')

@section('title', 'Edit Data SIMBK')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Data Bimbingan Konseling</h2>

    <form action="{{ route('simbk.update', $simbkData->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ $simbkData->nama_siswa }}" required>
        </div>

        <div class="mb-3">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ $simbkData->nisn }}" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ $simbkData->kelas }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L" {{ $simbkData->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $simbkData->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Topik Konseling</label>
            <input type="text" name="topik_konseling" class="form-control" value="{{ $simbkData->topik_konseling }}" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $simbkData->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Guru BK</label>
            <input type="text" name="guru_bk" class="form-control" value="{{ $simbkData->guru_bk }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="{{ $simbkData->status }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('simbk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
