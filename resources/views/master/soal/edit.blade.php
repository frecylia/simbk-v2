@extends('layouts.admin.app')

@section('title', 'Edit Soal')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Soal</h1>
    
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
            <form action="{{ route('soal.update', $soal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="pertanyaan">Pertanyaan</label>
                    <textarea class="form-control" name="pertanyaan" rows="4" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select class="form-control" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriMinat as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $soal->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('soal.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection