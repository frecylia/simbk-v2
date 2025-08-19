@extends('layouts.admin.app')

@section('title', 'Tambah Catatan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Catatan</h1>

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

    <form action="{{ route('catatan.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- Guru BK (User yang membuat catatan) --}}
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="user_id">Guru BK <span class="text-danger">*</span></label>
                    <select class="form-control" name="user_id" required>
                        <option value="">-- Pilih Guru BK --</option>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Siswa --}}
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="siswa_id">Siswa <span class="text-danger">*</span></label>
                    <select class="form-control" name="siswa_id" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->name }} ({{ $siswa->nis }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tanggal Konseling --}}
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="tanggal">Tanggal Konseling <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal') }}" required>
                </div>
            </
