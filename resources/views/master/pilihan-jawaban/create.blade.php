@extends('layouts.admin.app')

@section('title', 'Tambah Pilihan Jawaban')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Pilihan Jawaban</h1>
    
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
            <form action="{{ route('pilihan-jawaban.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="soal_id">Soal</label>
                    <select class="form-control" name="soal_id" required>
                        <option value="">-- Pilih Soal --</option>
                        @foreach($soal as $item)
                            <option value="{{ $item->id }}" {{ old('soal_id') == $item->id ? 'selected' : '' }}>
                                {{ Str::limit($item->pertanyaan, 100) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group mb-3">
                    <label for="teks_pilihan">Teks Pilihan</label>
                    <textarea class="form-control" name="teks_pilihan" rows="2" required>{{ old('teks_pilihan') }}</textarea>
                </div>
                
                <div class="form-group mb-3">
                    <label for="nilai">Nilai</label>
                    <input type="number" class="form-control" name="nilai" value="{{ old('nilai', 0) }}" required>
                </div>
                

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pilihan-jawaban.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection