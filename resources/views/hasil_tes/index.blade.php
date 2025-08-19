@extends('layouts.admin.app')

@section('title', 'Hasil Tes Minat Bakat')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Tabel Hasil Tes Minat & Bakat</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover" id="table-hasil">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Tanggal Tes</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminatan as $i => $hasil)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $hasil->user->name }}</td>
                        <td>{{ $hasil->user->nis }}</td>
                        <td>{{ $hasil->user->kelas }}</td>
                        <td>{{ $hasil->user->jurusan }}</td>
                        <td>{{ $hasil->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('hasil.show', $hasil->user->id) }}" class="btn btn-primary btn-sm">Lihat Hasil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
         $(document).ready(function() {
            $('#table-hasil').DataTable({});
        });
    </script>
@endpush
