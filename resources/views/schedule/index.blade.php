@extends('layouts.admin.app')

@section('title', 'Jadwal Konseling')

@section('content')
    @if(Auth::user()->hasRole('Siswa'))
        <div class="container-fluid">
            <div class="content-header">
                <h1>Jadwal</h1>
                @if (session('success'))
                    <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        
                @if (session('error'))
                    <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            
            </div>
            <div class="col-md-12">
                <div class="main-content">
                    <div class="mt-4">
                        <h4>Kalender Jadwal Konseling</h4>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Jadwal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('schedule.store')}}" method="POST" id="form-jadwal">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="schedule_date">Tanggal Jadwal</label>
                                        <input type="text" name="schedule_date" class="form-control" placeholder="Tanggal Jadwal" id="schedule_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="schedule_time">Jam Jadwal</label>
                                        <input type="time" name="schedule_time" class="form-control" id="schedule_time" min="09:00" max="17:00" required>
                                        <small class="text-muted">Pilih waktu antara 09:00 - 17:00</small>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="user_id">Guru BK</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">Pilih Guru BK</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label for="time_schedule">Keterangan</label>
                                        <textarea name="ketarangan" class="form-control" id="ketarangan" placeholder="keterangan" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        @include('schedule.detail')
    @else
        <div class="container-fluid">
            <div class="content-header">
                <h1>Data Jadwal Konseling</h1>
                @if (session('success'))
                    <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="main-content">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" id="schedulesTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Guru BK</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($schedules as $item)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->student?->name}}</td>
                                            <td>{{$item->schedule_date ? date('d-m-Y', strtotime($item->schedule_date)) : ''}}</td>
                                            <td>{{$item->schedule_time}}</td>
                                            <td>{{$item->teacher?->name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>
                                                @if (strtolower($item->status) == 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif (strtolower($item->status) == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif (strtolower($item->status) == 'ditolak')
                                                    <span class="badge bg-danger">Tolak</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (strtolower($item->status) == 'pending')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('schedule.approve', $item->id) }}">Approve</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('schedule.reject', $item->id) }}">Reject</a></li>
                                                    </ul>
                                                </div>
                                                @endif
                                            </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var tanggalTerisi = []; // akan diisi dari AJAX

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            validRange: {
                start: new Date().toISOString().split('T')[0]
            },
            events: "{{route('schedule.json')}}", // Ambil data dari Laravel

            dateClick: function (info) {
                const clickedDate = info.dateStr;
                const today = new Date().toISOString().split('T')[0];

                // Jika tanggal sudah lewat
                if (clickedDate < today) {
                    alert("Tanggal sudah lewat, tidak bisa memilih.");
                    return;
                }

                // Jika tanggal sudah digunakan (disable klik)
                if (tanggalTerisi.includes(clickedDate)) {
                    alert("Tanggal sudah terisi jadwal, silakan pilih tanggal lain.");
                    return;
                }

                // Masukkan ke form/modal
                document.getElementById('schedule_date').value = new Date(clickedDate).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                const modal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                modal.show();
            },

            eventClick: function (info) {
                const start = info.event.start;
                const props = info.event.extendedProps;
               
                $("#t-siswa").text(props.siswa);
                $("#t-guru").text(props.guru);
                $("#t-time").text(props.schedule_time);
                $("#t-deskripsi").text(props.deskripsi);
                

                const modal = new bootstrap.Modal(document.getElementById('modal-detail-schedule'));
                modal.show();
            },

            eventDidMount: function(info) {
                // Simpan tanggal-tanggal yang sudah ada jadwal
                const tanggal = info.event.startStr;
                if (!tanggalTerisi.includes(tanggal)) {
                    tanggalTerisi.push(tanggal);
                }
            }
        });

        calendar.render();
    });

    $(document).ready(function() {
        $('#schedulesTable').DataTable({});
    });
</script>
@endpush


