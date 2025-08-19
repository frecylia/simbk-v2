@extends('layouts.app')

@section('title', 'Data Bimbingan Konseling')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Bimbingan Konseling</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('simbk.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Topik Konseling</th>
                <th>Tanggal</th>
                <th>Guru BK</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->topik_konseling }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->guru_bk }}</td>
                    <td>{{ $item->status ?? '-' }}</td>
                    <td>
                        <a href="{{ route('simbk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('simbk.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
