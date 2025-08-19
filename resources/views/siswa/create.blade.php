@extends('layouts.admin.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Siswa</h1>
    {{-- Notifikasi jika ada error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan dalam pengisian data:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nis">NIS</label>
            <input type="text" class="form-control" name="nis" value="{{ old('nis') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="kelas">Kelas</label>
            <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" name="jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="IPS" {{ old('jurusan') == 'IPS' ? 'selected' : '' }}>IPS</option>
                <option value="IPA" {{ old('jurusan') == 'IPA' ? 'selected' : '' }}>IPA</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
