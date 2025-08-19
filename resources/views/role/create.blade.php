@extends('layouts.admin.app')

@section('title', 'Tambah Role')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Role</h1>

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

    <form action="{{ route('role.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="name">Nama Role <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection