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
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Jadwal Konseling</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form action="{{route('schedule.store')}}" method="POST" id="form-jadwal">
                        @csrf
                        <input type="hidden" name="schedule_date" id="schedule_date">
                        <input type="hidden" name="user_id" id="selected_teacher_id">
                        <input type="hidden" name="schedule_time" id="selected_schedule_time">

                        <div class="modal-body">
                            <div id="availability-view">
                                <div class="mb-3">
                                    <strong>Jadwal Tersedia untuk Tanggal:</strong>
                                    <p id="selected_date_text" class="fs-5 text-primary"></p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Guru BK</th>
                                                <th>Jadwal Tersedia</th>
                                            </tr>
                                        </thead>
                                        <tbody id="teacher-availability-table-body">
                                            <tr>
                                                <td colspan="2" class="text-center">Memuat jadwal...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="confirmation-view" style="display: none;">
                                <h5 class="mb-3">Konfirmasi Jadwal Anda</h5>
                                <div id="confirmation-details" class="alert alert-info">
                                </div>
                                <div class="form-group">
                                    <label for="description">Keterangan (Opsional)</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="Jelaskan singkat masalah Anda jika perlu" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            {{-- Tombol simpan hanya muncul di tampilan konfirmasi --}}
                            <button type="submit" class="btn btn-primary" id="submit-schedule-btn" style="display: none;">Konfirmasi & Buat Jadwal</button>
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
        var scheduleModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
        var detailModal = new bootstrap.Modal(document.getElementById('modal-detail-schedule'));
        var availabilityView = document.getElementById('availability-view');
        var confirmationView = document.getElementById('confirmation-view');
        var submitBtn = document.getElementById('submit-schedule-btn');
        var tableBody = document.getElementById('teacher-availability-table-body');
        var myBookedDates = [];

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            locale: 'id',
            validRange: { start: new Date().toISOString().split('T')[0] },
            events: "{{route('schedule.json')}}",
            eventDidMount: function(info) {
                // Ambil hanya bagian tanggal (YYYY-MM-DD)
                const eventDate = info.event.startStr.split('T')[0];
                if (!myBookedDates.includes(eventDate)) {
                    myBookedDates.push(eventDate);
                }
            },
            dateClick: function (info) {
                let lanjutkan = true; 
                const clickedDate = info.dateStr;

                if (myBookedDates.includes(clickedDate)) {
               
                    lanjutkan = alert("Anda sudah memiliki jadwal pada tanggal ini !!");
                }

                if (lanjutkan) {
                    tableBody.innerHTML = '<tr><td colspan="2" class="text-center">Memuat jadwal...</td></tr>';
                    availabilityView.style.display = 'block';
                    confirmationView.style.display = 'none';
                    submitBtn.style.display = 'none';
                    document.getElementById('form-jadwal').reset(); 
                    document.getElementById('schedule_date').value = clickedDate;
                    document.getElementById('selected_date_text').innerText = new Date(clickedDate).toLocaleDateString('id-ID', {
                        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                    });
                    fetch(`{{ route('schedule.availability') }}?date=${clickedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        tableBody.innerHTML = '';
                        if (data.length === 0) {
                            tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Tidak ada jadwal yang tersedia pada tanggal ini.</td></tr>';
                            return;
                        }

                        data.forEach(teacher => {
                            let slotsHtml = '';
                            teacher.slots.forEach(slot => {
                                slotsHtml += `<button type="button" class="btn btn-outline-primary btn-sm m-1 select-slot-btn" 
                                                data-teacher-id="${teacher.id}" 
                                                data-teacher-name="${teacher.name}" 
                                                data-time="${slot}">
                                                ${slot}
                                            </button>`;
                            });

                            let row = `<tr>
                                        <td><strong>${teacher.name}</strong></td>
                                        <td>${slotsHtml}</td>
                                    </tr>`;
                            tableBody.innerHTML += row;
                        });
                        scheduleModal.show();
                    })
                    .catch(error => {
                        console.error('Error fetching availability:', error);
                        tableBody.innerHTML = '<tr><td colspan="2" class="text-center text-danger">Gagal memuat jadwal. Silakan coba lagi.</td></tr>';
                    });
                }
            },

            eventClick: function (info) {
                const start = info.event.start;
                const props = info.event.extendedProps;
               
                $("#t-siswa").text(props.siswa);
                $("#t-guru").text(props.guru);
                $("#t-time").text(props.schedule_time);
                $("#t-deskripsi").text(props.deskripsi);
                $("#t-status").html(props.status);


                const modal = new bootstrap.Modal(document.getElementById('modal-detail-schedule'));
                modal.show();
            },

            
        });

        calendar.render();
        $('#teacher-availability-table-body').on('click', '.select-slot-btn', function() {
            // Ambil data dari atribut data-* tombol
            const teacherId = $(this).data('teacher-id');
            const teacherName = $(this).data('teacher-name');
            const time = $(this).data('time');
            const dateText = $('#selected_date_text').text();

            // Isi input tersembunyi untuk form submission
            $('#selected_teacher_id').val(teacherId);
            $('#selected_schedule_time').val(time);

            // Tampilkan detail konfirmasi
            $('#confirmation-details').html(
                `Anda akan membuat janji temu dengan <strong>${teacherName}</strong> pada hari <strong>${dateText}</strong>, pukul <strong>${time}</strong>.`
            );

            // Ganti tampilan modal dari tabel ke konfirmasi
            availabilityView.style.display = 'none';
            confirmationView.style.display = 'block';
            submitBtn.style.display = 'block';
        });

    });

    $(document).ready(function() {
        $('#schedulesTable').DataTable({});
    });
</script>
@endpush


