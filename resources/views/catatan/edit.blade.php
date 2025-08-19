@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Catatan Konseling</h2>

    <form action="{{ route('catatan.update', $catatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_siswa" class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="{{ $catatan->nama_siswa }}" required>
        </div>

        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ $catatan->kelas }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="4" class="form-control" required>{{ $catatan->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('catatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
