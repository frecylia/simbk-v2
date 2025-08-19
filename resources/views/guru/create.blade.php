@extends('layouts.admin.app')

@section('title', 'Tambah Guru')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Guru</h1>

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

    <form action="{{ route('guru.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nis">NIP</label>
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

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
