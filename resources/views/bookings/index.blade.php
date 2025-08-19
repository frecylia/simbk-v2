@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Jadwal Konseling Tersedia</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Guru BK</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($availabilities as $schedule)
            <tr>
                <td>{{ $schedule->teacher->name }}</td>
                <td>{{ $schedule->schedule_date }}</td>
                <td>{{ $schedule->schedule_time }}</td>
                <td>
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <button type="submit" class="btn btn-primary btn-sm">Booking</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada jadwal tersedia</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
