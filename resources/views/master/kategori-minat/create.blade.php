@extends('layouts.admin.app')

@section('title', 'Tambah Kategori Minat')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Kategori Minat</h1>
    
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
            <form action="{{ route('kategori-minat.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" value="{{ old('nama_kategori') }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kategori-minat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection