@extends('layouts.admin.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="container mt-4">
<h1>Edit Siswa</h1>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- NIS -->
    <div class="form-group">
        <label for="nis">NIS</label>
        <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" required>
    </div>

    <!-- Nama Lengkap -->
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" value="{{ $siswa->name }}" required>
    </div>

    <!-- Kelas -->
    <div class="form-group">
        <label for="kelas">Kelas</label>
        <input type="text" class="form-control" name="kelas" value="{{ $siswa->kelas }}" required>
    </div>

    <!-- Jenis Kelamin -->
    <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <select class="form-control" name="jurusan" required>
            <option value="">-- Pilih Jurusan --</option>
            <option value="IPA" {{ $siswa->jurusan == 'IPA' ? 'selected' : '' }}>IPA</option>
            <option value="IPS" {{ $siswa->jurusan == 'IPS' ? 'selected' : '' }}>IPS</option>
        </select>
    </div>

    <!-- No. Telepon -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $siswa->email }}">
    </div>

     <!-- Password -->
     <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="{{ $siswa->siswa123 }}">
    </div>

    <!-- Tombol -->
    <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary mt-2">Batal</a>
</form>
</div>
@endsection
