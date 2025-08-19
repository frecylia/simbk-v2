@extends('layouts.admin.app')

@section('title', 'Edit Guru')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Guru</h1>

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

    <form action="{{ route('guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nis">NIP</label>
            <input type="text" class="form-control" name="nis" value="{{ $guru->nis }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" value="{{ $guru->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $guru->email }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
