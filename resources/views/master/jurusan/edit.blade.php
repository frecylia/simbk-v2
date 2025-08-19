@extends('layouts.admin.app')

@section('title', 'Edit Jurusan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Jurusan</h1>
    
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="nama_jurusan">Nama Jurusan</label>
                    <input type="text" class="form-control" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label for="kategori_dominan_id">Kategori Dominan</label>
                    <select class="form-control" name="kategori_dominan_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriMinat as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_dominan_id', $jurusan->kategori_dominan_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection