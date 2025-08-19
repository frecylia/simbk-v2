@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah User</h1>

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

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="nis">NIP/NIS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nis" value="{{ old('nis') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="role">Role <span class="text-danger">*</span></label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" name="kelas" id="kelas" value="{{ old('kelas') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="jurusan">Jurusan</label>
                    <select class="form-control" name="jurusan" id="jurusan">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="IPS" {{ old('jurusan') == 'IPS' ? 'selected' : '' }}>IPS</option>
                        <option value="IPA" {{ old('jurusan') == 'IPA' ? 'selected' : '' }}>IPA</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
     document.getElementById('role').addEventListener('change', function () {
        if (this.value === 'Siswa') {
            document.getElementById('kelas').parentElement.classList.remove('d-none');
            document.getElementById('jurusan').parentElement.classList.remove('d-none');
        } else {
            document.getElementById('kelas').parentElement.classList.add('d-none');
            document.getElementById('jurusan').parentElement.classList.add('d-none');
        }
    });
</script>

@endpush