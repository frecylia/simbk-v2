@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Catatan Konseling</h2>

    {{-- Tombol tambah data --}}
    <a href="{{ route('catatan.create') }}" class="btn btn-primary mb-3">+ Tambah Catatan</a>

    {{-- Tabel data --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($catatan as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->nama_siswa }}</td>
                    <td>{{ $c->kelas }}</td>
                    <td>{{ $c->keterangan }}</td>
                    <td>
                        <a href="{{ route('catatan.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('catatan.destroy', $c->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada catatan konseling</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
