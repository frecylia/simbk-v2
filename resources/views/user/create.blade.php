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
            {{-- Input User Dasar --}}
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
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="role">Role <span class="text-danger">*</span></label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="">-- Pilih Role --</option>
                        {{-- Asumsi $roles dikirim dari controller --}}
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Input Khusus Siswa (Awal) --}}
            <div id="siswa-fields" class="row d-none ms-0">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan">
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="IPS" {{ old('jurusan') == 'IPS' ? 'selected' : '' }}>IPS</option>
                            <option value="IPA" {{ old('jurusan') == 'IPA' ? 'selected' : '' }}>IPA</option>
                        </select>
                    </div>
                </div>
            </div>
          
            <div id="jadwal-ketersediaan-section" class="col-12 d-none">
                <hr>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h4 class="mb-3">Jadwal Ketersediaan</h4>
                        <div>
                        <button type="button" id="tambah-jadwal-btn" class="btn btn-success mt-2">Tambah Jadwal</button>

                        </div>
                    </div>
                    <div class="col-md-12" id="jadwal-list">
                    </div>
                </div>
                  
                        
                <hr>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    // Fungsi untuk mengatur tampilan form berdasarkan role yang dipilih
    function toggleFormFields(selectedRole) {
        if (selectedRole === 'Siswa') {
            $('#siswa-fields').removeClass('d-none');
            $('#jadwal-ketersediaan-section').addClass('d-none');
        } else if (selectedRole === 'GuruBK') {
            $('#siswa-fields').addClass('d-none');
            $('#jadwal-ketersediaan-section').removeClass('d-none');
        } else {
            $('#siswa-fields').addClass('d-none');
            $('#jadwal-ketersediaan-section').addClass('d-none');
        }
    }

    // Panggil fungsi saat halaman pertama kali dimuat (jika ada old value)
    var initialRole = $('#role').val();
    if (initialRole) {
        toggleFormFields(initialRole);
    }

    // Event listener saat role diganti
    $('#role').on('change', function () {
        toggleFormFields(this.value);
    });

    var jadwalIndex = 0;
    // Event listener untuk tombol "Tambah Jadwal"
    $('#tambah-jadwal-btn').on('click', function() {
        jadwalIndex++;
        var newRow = `
            <div class="row align-items-center mb-2 jadwal-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="availabilities[${jadwalIndex}][day_of_week]" class="form-control" required>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" name="availabilities[${jadwalIndex}][start_time]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" name="availabilities[${jadwalIndex}][end_time]" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-danger hapus-jadwal-btn">Hapus</button>
                    </div>
                </div>
            </div>`;
        $('#jadwal-list').append(newRow);
    });

    // Event listener untuk tombol "Hapus" (menggunakan event delegation)
    $('#jadwal-list').on('click', '.hapus-jadwal-btn', function() {
        $(this).closest('.jadwal-row').remove();
    });
});
</script>
@endpush